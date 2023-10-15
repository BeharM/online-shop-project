<script>
    $(".update-cart-from").click(function (e) {
        e.preventDefault();
        var cart = $(this);
        $.ajax({
            url: '{{ url('/update-cart') }}',
            method: "PUT",
            data: {
                _token: '{{ csrf_token() }}',
                id: cart.attr("data-id"),
                quantity: cart.parents("tr").find("#quantity").val()
            },
            success: function (response) {
                if(response.code == 200) {
                    window.location.reload();
                }else{
                    alert(response.message)
                }
            }
        });
    });
</script>
