@if (Session::has('success.message'))
    <script>
        swal({
        	title: "{{  trans('updates.success') }}", 
        	text: "{{ Session::get('success.message') }}", 
        	type: "success",  
        	confirmButtonText: "Tamam" 
        	});
    </script>
    @elseif (Session::has('error.message'))
    <script>
        swal({
        	title: "{{  trans('updates.error') }}", 
        	text: "{{ Session::get('error.message') }}", 
        	type: "error",  
        	confirmButtonText: "Tamam"
        	});
    </script>
@endif