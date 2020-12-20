<?php
session_start();
include "session/verify.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Nelson Mandela</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../layout/css/sidebar.css" type="text/css">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
    <script src="loads/html2pdf.js"></script>
    <script src="loads/pdf.js"></script>
</head>
<body>

    <?php
        require_once "../layout/user.php";
    ?>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">Editor de texto</a>
    </nav>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />
    <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />

    <div class="card">
    <div class="card-body">

    <div id="standalone-container">
    <div id="toolbar-container">
        <span class="ql-formats">
        <select class="ql-font"></select>
        <select class="ql-size"></select>
        </span>
        <span class="ql-formats">
        <button class="ql-bold"></button>
        <button class="ql-italic"></button>
        <button class="ql-underline"></button>
        <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
        <select class="ql-color"></select>
        <select class="ql-background"></select>
        </span>
        <span class="ql-formats">
        <button class="ql-script" value="sub"></button>
        <button class="ql-script" value="super"></button>
        </span>
        <span class="ql-formats">
        <button class="ql-header" value="1"></button>
        <button class="ql-header" value="2"></button>
        <button class="ql-blockquote"></button>
        <button class="ql-code-block"></button>
        </span>
        <span class="ql-formats">
        <button class="ql-list" value="ordered"></button>
        <button class="ql-list" value="bullet"></button>
        <button class="ql-indent" value="-1"></button>
        <button class="ql-indent" value="+1"></button>
        </span>
        <span class="ql-formats">
        <button class="ql-direction" value="rtl"></button>
        <select class="ql-align"></select>
        </span>
        <span class="ql-formats">
        <button class="ql-link"></button>
        <button class="ql-image"></button>
        <button class="ql-video"></button>
        <button class="ql-formula"></button>
        </span>
        <span class="ql-formats">
        <button class="ql-clean"></button>
        </span>
    </div>
    <div id="editor-container" style="border: 0">
    </div>
    </div>

    </div>
    </div>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>


    <script>
    var quill = new Quill('#editor-container', {
        modules: {
        syntax: true,
        toolbar: '#toolbar-container'
        },
        placeholder: 'Digite aqui',
        theme: 'snow'
    });

    quill.on('text-change', function(delta, source) {
	updateHtmlOutput()
    })

    // When the convert button is clicked, update output
    $('#btn-convert').on('click', () => { updateHtmlOutput() })

    // Return the HTML content of the editor
    function getQuillHtml(){
        return quill.root.innerHTML;
    }


    function updateHtmlOutput(){
        let html = getQuillHtml();
        //ocument.getElementById('conteudo').value = html;
    }

    updateHtmlOutput()

    </script>

    <nav class="navbar navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="navbar-text">
                    - Certifique-se que seu navegar permita fazer downloads neste site.
                    <br>
                    - Aguarde após gerar o PDF, este processo pode demorar até minutos de acordo com o tamanho do texto.
                </span>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a href="index.php"><button type="button" class="btn btn-outline-secondary">Voltar</button></a>
                <button id="btnCrearPdf" class="btn btn-outline-primary">Gerar PDF</button>
            </li>
        </ul>
    </nav>

</body>
</html>