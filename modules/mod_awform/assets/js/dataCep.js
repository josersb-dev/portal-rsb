function awDataCep(form) {
    let $form = $(form);

    async function adicionarEndereco() {
        const cepInput = $form.find('[data-cep]');
        if(cepInput.val() === undefined){
            return false;
        }
        const cep = cepInput.val().replace(/\D/g, ''); // Remover caracteres não numéricos


        if (cep.length === 8) {
            const url = `https://viacep.com.br/ws/${cep}/json/`;
            try {
                const response = await fetch(url);
                const endereco = await response.json();

                if (!endereco.erro) {
                    for (const prop in endereco) {
                        const input = $form.find(`[data-${prop}]`);
                        if (input.length) {
                            if (prop === 'uf') {
                                const select = input;
                                select.val(endereco[prop]);
                            } else {
                                input.val(endereco[prop]);
                            }
                        }
                    }
                    //console.log("Endereço adicionado com sucesso:");
                    //console.log(endereco);
                } else {
                    //console.log("CEP não encontrado.");
                }
            } catch (error) {
                console.error("Erro ao adicionar o endereço:", error);
            }
        } else {
            // Se o campo do CEP estiver vazio, limpar todos os campos de endereço
            limparCamposEndereco();
        }
    }

    function limparCamposEndereco() {
        const inputsEndereco = $form.find('[data-logradouro], [data-bairro], [data-localidade], [data-complemento]');
        inputsEndereco.val('');
        const selectEstado = $form.find('[data-uf]');
        selectEstado.val('');
    }

    if($form.find('[data-cep]'))
        $( document ).on('input',$form.find('[data-cep]'), adicionarEndereco);

    // Preencher o select de estados
    const selectEstado = $form.find('[data-uf]');
    const estados = [
        { sigla: '', nome: 'Selecione o Estado' },
        { sigla: 'AC', nome: 'Acre' },
        { sigla: 'AL', nome: 'Alagoas' },
        { sigla: 'AP', nome: 'Amapá' },
        { sigla: 'AM', nome: 'Amazonas' },
        { sigla: 'BA', nome: 'Bahia' },
        { sigla: 'CE', nome: 'Ceará' },
        { sigla: 'DF', nome: 'Distrito Federal' },
        { sigla: 'ES', nome: 'Espírito Santo' },
        { sigla: 'GO', nome: 'Goiás' },
        { sigla: 'MA', nome: 'Maranhão' },
        { sigla: 'MT', nome: 'Mato Grosso' },
        { sigla: 'MS', nome: 'Mato Grosso do Sul' },
        { sigla: 'MG', nome: 'Minas Gerais' },
        { sigla: 'PA', nome: 'Pará' },
        { sigla: 'PB', nome: 'Paraíba' },
        { sigla: 'PR', nome: 'Paraná' },
        { sigla: 'PE', nome: 'Pernambuco' },
        { sigla: 'PI', nome: 'Piauí' },
        { sigla: 'RJ', nome: 'Rio de Janeiro' },
        { sigla: 'RN', nome: 'Rio Grande do Norte' },
        { sigla: 'RS', nome: 'Rio Grande do Sul' },
        { sigla: 'RO', nome: 'Rondônia' },
        { sigla: 'RR', nome: 'Roraima' },
        { sigla: 'SC', nome: 'Santa Catarina' },
        { sigla: 'SP', nome: 'São Paulo' },
        { sigla: 'SE', nome: 'Sergipe' },
        { sigla: 'TO', nome: 'Tocantins' }
    ];
    estados.forEach(estado => {
        const option = $('<option>').val(estado.sigla).text(estado.nome);
        if (selectEstado.length)
            selectEstado.append(option);
    });
}

