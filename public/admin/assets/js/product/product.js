$(() => {
    ClassicEditor.create(document.querySelector("#description"), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    })
        .then((editor) => {
            window.editor = editor;
        })
        .catch((err) => {
            console.error(err.stack);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#show-image").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
            $("#image-input").change(function () {
                readURL(this);
            });
        


            $(document).ready(function() {
                // {{-- // Handle click event on "Add Size" button --}}
                $('#add-size').click(function() {
                    var sizeId = $('#size-dropdown').val();
                    var sizeName = $('#size-dropdown option:selected').text();
                    
                    if (sizeId && sizeName) {
                        var sizeRow = $('<div class="size-row"></div>');
                        sizeRow.append('<label>'+'Size:' + sizeName + '</label>');
                        sizeRow.append('<input type="number" name="sizes[' + sizeId + '][price]">');
                        
                        sizeRow.append('<button type="button" class="remove-size">Remove</button>');
                        
                        $('#sizes-container').append(sizeRow);
                    }
                });
                
                // Handle click event on "Remove" button
                $(document).on('click', '.remove-size', function() {
                    $(this).closest('.size-row').remove();
                });
            });
   
            
        
});
