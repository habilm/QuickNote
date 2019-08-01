<?php
defined("BASEPATH") or exit("GO Hell");
echo doctype("html");
?>
<html>
<head>
<title>QuickNote</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 

echo link_tag(base_url()."assets/css/fa/fontawesome-all.css");
echo link_tag(base_url()."assets/css/bootstrap.min.css");
echo link_tag(base_url()."assets/css/main.css");
?>
<script>
    var baseUrl= "<?php echo base_url(); ?>";
</script>
</head>
<body>
