<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicado Escolar - IFES</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #329835;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 13px;
            opacity: 0.9;
        }
        .content {
            padding: 25px;
        }
        .greeting {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-box {
            background-color: #f8faf9;
            border-left: 4px solid #329835;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-row {
            margin-bottom: 8px;
            font-size: 14px;
        }
        .info-label {
            font-weight: bold;
            color: #555555;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 12px;
            text-transform: uppercase;
        }
        .badge-baixa { background-color: #d1e7dd; color: #0f5132; }
        .badge-media { background-color: #fff3cd; color: #664d03; }
        .badge-alta { background-color: #f8d7da; color: #842029; }
        .descricao-box {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 4px;
            margin-top: 5px;
            font-size: 14px;
            line-height: 1.5;
            color: #4a5568;
        }
        .footer {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho Institucional -->
        <div class="header">
            <h1>IFES - Campus Alegre</h1>
            <p>Coordenação de Atendimento ao Educando</p>
        </div>

        <!-- Conteúdo Principal -->
        <div class="content">
            <div class="greeting">
                Prezado(a) Responsável,
            </div>

            <p style="font-size: 14px; line-height: 1.5;">
                Informamos que foi registrada uma nova ocorrência disciplinar/acadêmica referente ao aluno(a) sob sua responsabilidade.
            </p>

            <!-- Ficha resumida -->
            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">Aluno:</span> {{ $ocorrencia->aluno->nome }}
                </div>
                <div class="info-row">
                    <span class="info-label">Matrícula:</span> {{ $ocorrencia->aluno->matricula }}
                </div>
                <div class="info-row">
                    <span class="info-label">Turma:</span> {{ $ocorrencia->aluno->turma->nome ?? 'Não informada' }}
                </div>
                <div class="info-row">
                    <span class="info-label">Data do Fato:</span> {{ \Carbon\Carbon::parse($ocorrencia->data_ocorrencia)->format('d/m/Y') }}
                </div>
                <div class="info-row">
                    <span class="info-label">Infração:</span> <strong>{{ $ocorrencia->titulo }}</strong>
                </div>
                <div class="info-row" style="margin-top: 10px;">
                    <span class="info-label">Nível de Gravidade:</span> 
                    @if($ocorrencia->gravidade === 'baixa')
                        <span class="badge badge-baixa">Leve / Orientação</span>
                    @elseif($ocorrencia->gravidade === 'media')
                        <span class="badge badge-media">Média / Advertência</span>
                    @else
                        <span class="badge badge-alta">Grave / Reunião</span>
                    @endif
                </div>
            </div>

            <!-- Detalhes do ocorrido -->
            <div style="margin-top: 15px;">
                <span class="info-label">Observações e Detalhes:</span>
                <div class="descricao-box">
                    {{ $ocorrencia->descricao }}
                </div>
            </div>

            <p style="font-size: 13px; color: #666666; margin-top: 20px; line-height: 1.4;">
                Pedimos a gentileza de orientar o estudante sobre a importância do cumprimento das normas institucionais. Caso necessário, entre em contato com a coordenação pedagógica do campus.
            </p>
        </div>

        <!-- Rodapé do E-mail -->
        <div class="footer">
            Este é um e-mail automático enviado pelo Sistema de Gerenciamento de Ocorrências do IFES Campus Alegre.<br>
            Por favor, não responda diretamente a esta mensagem.
        </div>
    </div>
</body>
</html>