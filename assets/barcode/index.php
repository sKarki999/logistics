<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>

<div id="demo"></div>
<script type="text/javascript">
	$("#demo").barcode(
		"1234567890128",// Value barcode (dependent on the type of barcode)
		"ean13" // type (string)
	);

</script>