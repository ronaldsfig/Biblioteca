<?php
session_start();
include "../classes/connect.class.php";
include "../classes/user.class.php";
include "session/verify.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Nelson Mandela</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
    <link href="../layout/css/sidebar.css" rel="stylesheet">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

    <?php
        require_once "../layout/user.php";
    ?>

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">Nova publicação</span>
    </nav>

    <form method="post" action="publicar.act.php">

    <div class="input-group input-group-lg mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-lg">Título</span>
        </div>
        <input type="text" name="titulo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Subtítulo</span>
        </div>
        <input type="text" name="subtitulo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />
    <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />

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
    <div id="editor-container" style="height: 500px">
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

    // Highlight code output
    function updateHighlight(){
        hljs.highlightBlock( document.querySelector('#output-html') )
    }


    function updateHtmlOutput(){
        let html = getQuillHtml();
        console.log ( html );
        document.getElementById('output-html').innerText = html;
        document.getElementById('conteudo').value = html;
        updateHighlight();
    }


    updateHtmlOutput()
    </script>

    <pre><code id="output-html"></code></pre>
    <input type="hidden" name="conteudo" value="" id="conteudo">

    <nav class="navbar navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="navbar-text">
                    Autoria: <?php echo $_SESSION['user']['nome']?>, <?php echo date("d/m/Y")?>
                </span>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <button type="submit" class="btn btn-outline-primary">Publicar</button>
                <a href="index.php"><button type="button" class="btn btn-outline-danger">Voltar</button></a>
            </li>
        </ul>
    </nav>

    </form>

</body>