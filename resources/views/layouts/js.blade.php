<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function () {
        $('.custom-select').on('change', function () {
            var target = $('option:selected').val()
            if(target != null){
                $('.placeholder').remove();
            }else{
                var opt = new Option('Choose the level', 0)
                $('.custom-select').append(opt)
            }

        })
    })
</script>
