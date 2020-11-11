<?php
session_start();
include "session/verify.php";
if (!isset($_POST['conteudo'])){
    header('Location: index.php');
    exit();
}
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
    <script type="text/javascript" src="gerar_pdf.js"></script>
</head>
<body>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />
<link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />

  <div id="editor-container">
  <?php echo $_POST['conteudo']?>
  </div>
</div>
  
<script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
  var quill = new Quill('#editor-container');

    const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
    (html2pdf()
    .set({
        margin: 1,
        filename: 'documento.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 3, // A mayor escala, mejores gráficos, pero más peso
            letterRendering: true,
        },
        jsPDF: {
            unit: "in",
            format: "a4",
            orientation: 'portrait' // landscape o portrait
        }
    })
    .from($elementoParaConvertir)
    .save()
    .catch(err => console.log(err))
    .finally()
    .then(() => {
        location.href = document.referrer;
    })
    );
    
</script>

</body>
</html>