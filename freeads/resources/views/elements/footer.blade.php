<script type="text/javascript">
    $('#search').select2({
        placeholder: 'Search',
        language: {
      noResults: function() {
        return '';
      },
    },
    escapeMarkup: function(markup) {
      return markup;
    },
        ajax: {
            url: '/ajax-autocomplete-search',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    }).on("select2:select", function(e) {
        var selected = e.params.data;
        console.log(selected);
        window.location = '/search/' + selected.text;
    });

    $(document).on('keydown', '.select2-search__field', function(e) {
        if (e.keyCode === 13) {
            var value = $('.select2-search__field').val();
            console.log(value);
            window.location = '/search/' + value;
        }
    });
</script>
</body>
<footer class="row footer">
    <div id="copyright text-right">© Copyright 2021 Ophelie Diomar </div>
</footer>
</div>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>