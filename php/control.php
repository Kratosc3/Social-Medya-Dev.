<html>
<style media="screen">
  .rep{
    margin-top: 110px;
    padding :5px;
    width: 50px;
    height: 50px;
    background-color: red;
    border-style: solid;
    border-width: 1px;

  }
</style>
<body>

Welcome <?php echo $_GET["name"]; ?>
<br>
Your email address is: <?php echo $_GET["email"]; ?>
<br>
<a class="rep" href=index.html type="button" name="button">back</a>
</body>
</html>
