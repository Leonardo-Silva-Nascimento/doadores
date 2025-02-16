<?php
    include 'config.php';
    $stmt     = $pdo->query("SELECT * FROM doadores");
    $doadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Doadores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Doadores</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#doadorModal">Novo Doador</button>
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Forma de Pagamento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody id="lista-doadores">
        <?php foreach ($doadores as $doador): ?>
            <tr>
                <td><?php echo htmlspecialchars($doador['nome']) ?></td>
                <td><?php echo htmlspecialchars($doador['email']) ?></td>
                <td><?php echo htmlspecialchars($doador['telefone']) ?></td>
                <td><?php echo htmlspecialchars($doador['forma_pagamento']) ?></td>
                <td>
                    <button class="btn btn-warning btn-sm btn-editar" data-id="<?php echo $doador['id'] ?>">Editar</button>
                    <button class="btn btn-danger btn-sm btn-deletar" data-id="<?php echo $doador['id'] ?>">Deletar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    </div>

    <!-- Modal para criação e edição de doador -->
    <div class="modal fade" id="doadorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Cadastrar Doador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formDoador">
                        <input type="hidden" id="doador_id">
                        <div class="mb-3">
                            <label>Nome:</label>
                            <input type="text" id="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email:</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Data de nascimento:</label>
                            <input type="date" id="data_nascimento" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Telefone:</label>
                            <input type="text" id="telefone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>CPF:</label>
                            <input type="text" id="cpf" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Valor da doação:</label>
                            <input type="text" id="valor_doacao" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Endereço:</label>
                            <input type="text" id="endereco" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Intervalo de Doação:</label>
                            <select id="intervalo_doacao" class="form-control">
                                <option value="Único">Único</option>
                                <option value="Bimestral">Bimestral</option>
                                <option value="Semestral">Semestral</option>
                                <option value="Anual">Anual</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Forma de Pagamento:</label>
                            <select id="forma_pagamento" class="form-control">
                                <option value="Débito">Débito</option>
                                <option value="Crédito">Crédito</option>
                            </select>
                        </div>
                        <div id="cartaoCampos" class="d-none">
                            <div class="mb-3">
                                <label>Bandeira do Cartão:</label>
                                <input type="text" id="bandeira_cartao" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>6 primeiros números:</label>
                                <input type="text" id="seis_primeiros_cartao" class="form-control" maxlength="6">
                            </div>
                            <div class="mb-3">
                                <label>4 últimos números:</label>
                                <input type="text" id="quatro_ultimos_cartao" class="form-control" maxlength="4">
                            </div>
                        </div>
                        <div id="contaCampo">
                            <div class="mb-3">
                                <label>Numero da conta:</label>
                                <input type="text" id="conta_bancaria" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#forma_pagamento').change(function() {
                if ($(this).val() === 'Crédito') {
                    $('#cartaoCampos').removeClass('d-none');
                    $('#contaCampo').addClass('d-none');
                } else {
                    $('#cartaoCampos').addClass('d-none');
                    $('#contaCampo').removeClass('d-none');
                }
            });

            $('.btn-editar').click(function() {
                const id = $(this).data('id');
                $.get("get_doador.php", { id: id }, function(doador) {
                    $('#doador_id').val(doador.id);
                    $('#nome').val(doador.nome);
                    $('#email').val(doador.email);
                    $('#cpf').val(doador.cpf);
                    $('#telefone').val(doador.telefone);
                    $('#data_nascimento').val(doador.data_nascimento);
                    $('#intervalo_doacao').val(doador.intervalo_doacao);
                    $('#valor_doacao').val(doador.valor_doacao);
                    $('#forma_pagamento').val(doador.forma_pagamento);
                    $('#endereco').val(doador.endereco);
                    if (doador.forma_pagamento === 'Crédito') {
                        $('#cartaoCampos').removeClass('d-none');
                        $('#contaCampo').addClass('d-none');
                    } else {
                        $('#cartaoCampos').addClass('d-none');
                    $('#contaCampo').removeClass('d-none');
                    }
                    $('#bandeira_cartao').val(doador.bandeira_cartao);
                    $('#seis_primeiros_cartao').val(doador.seis_primeiros_cartao);
                    $('#quatro_ultimos_cartao').val(doador.quatro_ultimos_cartao);
                    $('#conta_bancaria').val(doador.conta_bancaria);
                    $('#modalTitle').text("Editar Doador");
                    $('#doadorModal').modal('show');
                }, 'json');
            });

            $('.btn-deletar').click(function() {
                const id = $(this).data('id');

                if (confirm("Tem certeza que deseja excluir este doador?")) {
                    $.get("delete_doador.php", { id: id }, function(response) {
                        if (response.success) {
                            alert(response.success); 
                            location.reload();
                        } else if (response.error) {
                            alert(response.error); 
                        }
                    }, 'json').fail(function() {
                        alert("Ocorreu um erro ao tentar excluir o doador.");
                    });
                }
            });

            $("#formDoador").submit(function(event) {
                event.preventDefault();

                let dados = {
                    id: $('#doador_id').val(),
                    nome: $('#nome').val(),
                    email: $('#email').val(),
                    cpf: $('#cpf').val(),
                    telefone: $('#telefone').val(),
                    data_nascimento: $('#data_nascimento').val(),
                    intervalo_doacao: $('#intervalo_doacao').val(),
                    valor_doacao: $('#valor_doacao').val(),
                    forma_pagamento: $('#forma_pagamento').val(),
                    bandeira_cartao: $('#bandeira_cartao').val(),
                    seis_primeiros_cartao: $('#seis_primeiros_cartao').val(),
                    conta_bancaria: $('#conta_bancaria').val(),
                    quatro_ultimos_cartao: $('#quatro_ultimos_cartao').val(),
                    endereco: $('#endereco').val()
                };

                if($('#doador_id').val() == ''){
                    $.post("salvar_doador.php", dados, function(response) {
                        alert(response);
                        $('#doadorModal').modal('hide');
                        location.reload();
                    });
                }else{
                    $.post("editar_doador.php", dados, function(response) {
                    alert(response);
                    $('#doadorModal').modal('hide');
                    location.reload();
                });
                }
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
