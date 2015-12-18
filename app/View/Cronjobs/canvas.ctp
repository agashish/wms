<script type="text/javascript" src="/wms/js/html2canvas.js"></script>
<?php echo $html ?>
<input type="button" onclick ="html2canvas();" > 

<script>
     
    html2canvas(document.body, {
      onrendered: function(canvas) {
        document.body.appendChild(canvas);
        document.body.print(canvas);
      },
      width: 378,
      height: 570
    });


</script>

