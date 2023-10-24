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
        
    
            // $(document).ready(function() {
            //     $('#add-size-btn').on('click', function() {
            //         var newField = `
            //             <div class="size-row">
            //                 <div class="form-group">
            //                     <label for="size_name">Size Name:</label>
            //                     <input type="hidden" name="sizes[id][]" value="">
            //                     <input type="text" id="size_name" name="sizes[name][]" style="text-transform: uppercase" value="" required >
            //                 </div>
            //                 <div class="form-group">
            //                     <label for="price">Price:</label>
            //                     <input type="number" id="price" name="sizes[price][]" value="" required >
            //                 </div>
            //             </div>   
                       
            //         `;
                    
            //         $('#sizes-container').append(newField);
            //     });
            // });
            

            // $('#add-size-btn').click(function() {
            //     $.ajax({
            //         url: '/sizes', // Replace with the appropriate URL for your Laravel route or API endpoint
            //         type: 'GET',
            //         success: function(response) {
            //             // Handle the response data from the server
            //             var sizes = response.sizes;
                        
            //             // Display the sizes in a dropdown or modal
            //             // For example, assuming you have a dropdown element with id "size-dropdown":
            //             var dropdown = $('#size-dropdown');
            //             dropdown.empty();
            //             $.each(sizes, function(index, size) {
            //                 dropdown.append('<option value="' + size.id + '">' + size.name + '</option>');
            //             });
                        
            //             // Show the dropdown or modal
            //             // For example, assuming you have a dropdown element with id "size-dropdown":
            //             dropdown.show();
            //         },
            //         error: function(error) {
            //             console.log(error);
            //         }
            //     });
            // });

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
