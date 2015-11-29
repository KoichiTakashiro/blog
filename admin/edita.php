<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Replace Textareas by Class Name - CKEditor Sample</title>
    <meta content="text/html; charset=utf-8" http-equiv="content-type" />
    <script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>
</head>
<body>
  <h1>CKEditor Sample</h1>
<div id="alerts">
<noscript>
  <p>
    <strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
    support, like yours, you should still see the contents (HTML data) and you should
    be able to edit it normally, without a rich editor interface.
  </p>
</noscript>
</div>
<form action="posteddata.php" method="post">
  <p>
    <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"></textarea>
  </p>
  <p>
    <input type="submit" value="Submit" />
  </p>
</form>
</body>
</html>
