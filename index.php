<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Calc</title>
</head>

<body>
  <?php
    session_start();

    if (empty($_SESSION['calc'])) {
      $_SESSION['calc'] = '';
    }

    if (!empty($_POST['entrou']))
    {
      if (
        (
             substr($_SESSION['calc'], -1) == '*'
          || substr($_SESSION['calc'], -1) == '+'
          || substr($_SESSION['calc'], -1) == '-'
          || substr($_SESSION['calc'], -1) == '/'
        )
        &&
        (
             $_POST['valor'] == '+'
          || $_POST['valor'] == '-'
          || $_POST['valor'] == '/'
          || $_POST['valor'] == '*'
        )
        )
      {
        $_SESSION['calc'] = sprintf(substr($_SESSION['calc'], 0, -1), $_POST['valor']);
      }

      if ($_POST['valor'] != '=') {
        $_SESSION['calc'] = sprintf('%s%s', $_SESSION['calc'], $_POST['valor']);
      }

      if ($_POST['valor'] == '='
          &&
        (
             strpos($_SESSION['calc'], '-')
          || strpos($_SESSION['calc'], '+')
          || strpos($_SESSION['calc'], '*')
          || strpos($_SESSION['calc'], '/')
        )
        &&
        (
             substr($_SESSION['calc'], -1) != '*'
          && substr($_SESSION['calc'], -1) != '+'
          && substr($_SESSION['calc'], -1) != '-'
          && substr($_SESSION['calc'], -1) != '/'
        )
      ) {
        $valor = $result= eval('return ' . $_SESSION['calc'] .';');
        unset($_SESSION['calc']);
      } else {
        $valor = $_SESSION['calc'];
      }

      if ($_POST['valor'] == 'CE') {
        unset($_SESSION['calc']);
        $valor = 0;
      }
    }
  ?>
    <form method="POST">
        <div id="calculadora">
            <input type="text" value="entrou" name="entrou" style="display:none;">
            <input type="text" disabled id="visor" value="<?= !empty($valor) ? $valor : 0 ?>">
            <div id="primeira">
                <input type="submit" value="7" name="valor" class="bt">
                <input type="submit" value="8" name="valor" class="bt">
                <input type="submit" value="9" name="valor" class="bt">
                <input type="submit" value="/" name="valor" class="bt">
            </div>
            <div id="segunda">
                <input type="submit" value="4" name="valor" class="bt">
                <input type="submit" value="5" name="valor" class="bt">
                <input type="submit" value="6" name="valor" class="bt">
                <input type="submit" value="*" name="valor" class="bt">
            </div>
            <div id="terceira">
                <input type="submit" value="1" name="valor" class="bt">
                <input type="submit" value="2" name="valor" class="bt">
                <input type="submit" value="3" name="valor" class="bt">
                <input type="submit" value="-" name="valor" class="bt">
            </div>
            <div id="quarta">
                <input type="submit" value="CE" name="valor" class="bt">
                <input type="submit" value="0" name="valor" class="bt">
                <input type="submit" value="=" name="valor" class="bt">
                <input type="submit" value="+" name="valor" class="bt">
            </div>
        </div>
    </form>
</body>

</html>