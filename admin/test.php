<script type="text/javascript">
	var words = [];
var counts = [];

calculate(['a', 'b']);
calculate(['a', 'c']);
calculate(['a', 'b', 'c']);

function calculate(inputs) {
    for (var i = 0; i < inputs.length; i++) {
        var isExist = false;
        for (var j = 0; j < words.length; j++) {
            if (inputs[i] == words[j]) {
                isExist = true
                counts[i] = counts[i] + 1;
            }
        }
        if (!isExist) {
            words.push(inputs[i]);
            counts.push(1);
        }
        isExist = false;
    }
}

console.log(words);
console.log(counts);
</script>