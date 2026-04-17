@props([
    'name',
])

@error( $name )
    <span class="error error-span"
            x-init="()=> { 
                let errorSpan = document.getElementsByClassName('error-span')[0];
                if(errorSpan){
                    $('html, body').scrollTop($(errorSpan).offset().top - 100);
                }
        }">*{{ $message }}</span><br>
@enderror