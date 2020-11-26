<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <button id="minus">−</button>
	<input type="number" value="0" id="input"/>
	<button id="plus">+</button>

	<script type="text/javascript">
		const minusButton = document.getElementById('minus');
	const plusButton = document.getElementById('plus');
	const inputField = document.getElementById('input');

	minusButton.addEventListener('click', event => {
	  event.preventDefault();
	  const currentValue = Number(inputField.value) || 0;
	  inputField.value = currentValue - 1;
	});

	plusButton.addEventListener('click', event => {
	  event.preventDefault();
	  const currentValue = Number(inputField.value) || 0;
	  inputField.value = currentValue + 1;
	});
	</script>

</body>
</html>