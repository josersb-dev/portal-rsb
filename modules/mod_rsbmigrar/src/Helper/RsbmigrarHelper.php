<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_rsbmigrar
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\Rsbmigrar\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Table\Content;
use Joomla\CMS\Table\Asset;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Workflow\Workflow;
use Joomla\CMS\MVC\Model\WorkflowBehaviorTrait;

/**
 * Finder module helper.
 *
 * @since  2.5
 */
class RsbmigrarHelper
{   
	/**
	 * Method to get hidden input fields for a get form so that control variables
	 * are not lost upon form submission.
	 *
	 * @param   string   $route      The route to the page. [optional]
	 * @param   integer  $paramItem  The menu item ID. (@since 3.1) [optional]
	 *
	 * @return  string  A string of hidden input form fields
	 *
	 * @since   2.5
	 */
    public static function migrarDados(Array $dados)
    {
        // Crie uma instância da tabela de conteúdo
        $artigoTable = new Content(Factory::getDbo());
    
        // Preencha os dados do artigo
        $artigoData = $dados;
    
        $artigoTable->reset(); // Reset para garantir que os dados anteriores sejam limpos
        $artigoTable->bind($artigoData);
       
        $sucesso = 0;

        // Salve o artigo
        if (!$artigoTable->save($artigoData)) {
            $erro = 0;
            //echo 'Erro ao inserir na tabela de conteúdo: ' . $artigoTable->getError().'<br>';
        } else {
            //echo 'Artigo inserido com sucesso! ID: ' . $artigoTable->id . '<br>';
            $sucesso = 1;

            // Agora, obtemos o ID do artigo recém-inserido
            $novoArtigoId = $artigoTable->id;
    
            // Agora, lidamos com os assets usando a tabela de assets
            $assetTable = new Asset(Factory::getDbo());
            
            // Salvar o workflow--------------------------------------------------
            $artigoTable->type = 'com_content.article';
            $workflowAssetStageId = new Asset(Factory::getDbo());
            $workflowAssetStageId->load(['name' => 'com_content.stage.1']);

            $workflowStageId = self::getWorkflowStageId($workflowAssetStageId->get('id'));

            //Se não existir uma associação de fluxo então cria.
            if(!self::getWorkflowAssociation($novoArtigoId))
            {
                if(!self::setWorkflowAssociation($novoArtigoId,$workflowStageId)){
                    echo 'Erro ao criar fluxo de trabalho para o id '.$novoArtigoId;
                }
            }
    
            // Carregue o asset associado ao artigo
            if ($assetTable->load(array('name' => 'com_content.article.' . $novoArtigoId))) {
                // Se não existir, crie um novo
                if (!$assetTable->id) {
                    $assetTable->id = 0;
                    $assetTable->name = 'com_content.article.' . $novoArtigoId;
                    $assetTable->title = $title;
                    $assetTable->parent_id = 1; //parent
    
                    // ------------------------------- Salvando ------------------------
                    if (!$assetTable->save()) {
                        echo 'Erro ao inserir no sistema de controle de acesso: ' . $assetTable->getError();
                    } else {
                        echo 'Asset do artigo inserido com sucesso!<br>';
                    }
                }
            }
        }

        return $sucesso;
    }

    protected static function getWorkflowStageId($assetId): int
    {
        $db = Factory::getDbo();
        $query = $db
            ->getQuery(true)
            ->select('id')
            ->from($db->quoteName('#__workflow_stages'))
            ->where($db->quoteName('asset_id') . " = " . $db->quote($assetId));

        $db->setQuery($query);
        $result = $db->loadResult();

        return $result;
    }

    protected static function getWorkflowAssociation($itemId): int
    {
        $db = Factory::getDbo();
        $query = $db
            ->getQuery(true)
            ->select('item_id')
            ->from($db->quoteName('#__workflow_associations'))
            ->where($db->quoteName('item_id') . " = " . $db->quote($itemId));

        $db->setQuery($query);
        $result = $db->loadResult();

        return (int) $result;
    }

    protected static function setWorkflowAssociation($itemId,$stageId): bool
    {
        // Create and populate an object.
        $association = [];
        $association['item_id'] = $itemId;
        $association['stage_id'] = $stageId;
        $association['extension'] = 'com_content.article';

        $association = (object) $association;

        // Insert the object into the user profile table.
        $insert = Factory::getDbo()->insertObject('#__workflow_associations', $association);

        if(!$insert){
            return false;
        }

        return true;
    }
    
    protected static function imagemParaParametro($imagem,$legenda): string
    {      
        //Removendo elementos vazios, barras duplas, ou barra no inicio do código';
        $imagem = implode('/',array_filter(explode("/",$imagem)));
        $imagem = 'https://rsborgbr.s3.amazonaws.com/'.$imagem;
        return $imagem ? 
            '{"image_intro":"'.$imagem.'","image_intro_alt":"","float_intro":"","image_intro_caption":"'.$legenda.'","image_fulltext":"'.$imagem.'","image_fulltext_alt":"","float_fulltext":"","image_fulltext_caption":"'.$legenda.'"}' : '{}';
    }

    public static function headerNoticias($valor): string
    {
        $arr = [
            'destaque' => 'featured',
            'data' => 'created',
            'titulo' => 'title',
            'resumo' => 'introtext',
            'texto' => 'fulltext',
            'publicar_em' => 'publish_up'
        ];

        return $arr[$valor] ?? '';
    }

    public static function categoriaNoticias($id_segmento): int
    {
        $arr = [
            1 => 10, //Comunicação
            2 => 22, //Ensino Superior
            3 => 23, //Escolas
            4 => 24, //Pastoral
            5 => 25, //Social
            6 => 26, //ACSSA
            7 => 27, //Rede
        ];

        return $arr[$id_segmento] ?? 2;
    }


    //Convertendo os dados original para os do joomla
    protected static function setDados($arr)
    {
        $erros = 0;
        $sucesso = 0;
        foreach($arr as $ar)
        {
            $dados = array();
            foreach($ar as $name => $a)
            {
                if(self::headerNoticias($name)){
                    $dados[self::headerNoticias($name)] = $a;	
                }else{
                    switch($name){
                        case 'imagem':
                                $dados['images'] = self::imagemParaParametro($ar['imagem'],$ar['legenda']);
                            break;
                        case 'id_segmento':
                                $dados['catid'] = self::categoriaNoticias($ar['id_segmento']);
                            break;
                        case 'status':
                            $state = $ar['status'] == 1 ? 1 : 2;
                                $dados['state'] = $state;
                            break;
                    }
                } 
            }
            //Valores padrão
            $dados['language'] = '*';
            $dados['access'] = 1;

            //Migrando os dados
            $migrou = self::migrarDados($dados);

            if($migrou){
                $sucesso = $sucesso + 1;
            }else{
                $erros = $erros + 1;
            }
        }

        echo '<p class="alert alert-success" style="margin-top: 30px">Sucesso: '.$sucesso.'</p>
            <p class="alert alert-danger">Erro: '.$erros.'</p>';
    }


    //Capturando os dados do CSV -
    //return bool|array
    public static function dadosCSV()
    {

        $type = isset($_FILES['cronofile']) ? $_FILES['cronofile']['type'] : null;
        set_time_limit(0); // Desativa o limite de tempo

        if($type === 'text/csv')
        {
            // Exemplo de scrip para exibir os nomes obtidos no arquivo CSV de exemplo
            $delimitador = ';';
            $cerca = '"';

            $arquivo = $_FILES['cronofile']['name'];
            $arquivoTemp = $_FILES['cronofile']['tmp_name'];
            $diretorio = JPATH_ROOT.'/'.$arquivo;
                
            move_uploaded_file($arquivoTemp, $diretorio);

            // Abrir arquivo para leitura
            $f = fopen($diretorio, 'r');

            if ($f)
            { 
                $arr = array();
                
                // Ler cabecalho do arquivo
                $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
                $indD = array_search('data',$cabecalho);  
                
                $sucesso = 0;
                $erro = 0;

                // Enquanto nao terminar o arquivo
                while (!feof($f)) { 
                  
                    $arr1 = array();
                    // Ler uma linha do arquivo
                    $linha = fgetcsv($f, 0, $delimitador, $cerca);     

                    if (!$linha) {
                        continue;
                    }

                    $arrCombine = array_combine($cabecalho,$linha);
                    //array_push($arr,$cabecalho,$linha);
                    array_push($arr,$arrCombine);
                    // Montar registro com valores indexados pelo cabecalho
                    $registro = array_combine($cabecalho, $linha);

                    // Obtendo o nome
                    //echo $registro['tipo_de_instalacao'].PHP_EOL;
                }
                fclose($f);
                
            }

            //Atlerando os duplicados, para Cópia (n) no final
            $arr = self::comDuplicados($arr,'titulo','id_segmento');

            $limit = 100;
            $arrs = array_chunk($arr, $limit);

            foreach($arrs as $k=> $arr){
               //Setando os dados
                self::setDados(array_filter($arr));
            }

            //remover arquivo
            unlink($diretorio);
        }else{
            return false;
        }
    }

    public static function comDuplicados($arr, $qual, $qual2)
    {
        $counters = array(); // Inicializa o array de contadores

        $arr = array_map(function($item) use (&$counters, $qual, $qual2) {
            // Remove espaços em branco do título
            $titulo = trim($item[$qual]);
            
            // Cria uma chave composta combinando o título e o id_segmento
            $chave = $titulo . '|' . $item[$qual2];
            
            // Inicializa o contador para a chave atual, se necessário
            if (!isset($counters[$chave])) {
                $counters[$chave] = 0;
            }
            
            // Verifica se a chave já existe
            $chave_atualizada = $chave;
            if ($counters[$chave] > 0) {
                $titulo_atualizado = $titulo . ' Cópia (' . $counters[$chave] . ')';
                $chave_atualizada = $titulo_atualizado . '|' . $item[$qual2];
            }
            
            // Incrementa o contador para a chave atual
            $counters[$chave]++;
            
            // Separa a chave composta de volta em título e id_segmento
            list($titulo, $id_segmento) = explode('|', $chave_atualizada);
            
            // Atualiza o título e o id_segmento no item
            $item[$qual] = $titulo;
            $item[$qual2] = $id_segmento;
            
            return $item;
        }, $arr);
        
        return $arr;
    }
}