<x-app-layout>
<style>
	.Reply{


	background-color: #f1f1f1;
    padding: 0.5em;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-weight: bold;
    font-style: italic;
    }
</style>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

<div class="container">
    <div class="card" >
       
        <div class="card-header"><span>Feedback Detail</span><a style="color: black;" type="button" data-bs-toggle="modal"  data-bs-target="#commentModal"  class="float-right btn btn-primary "   >Reply on Feedback</a >
        	<!-- Button to trigger the modal -->


<!-- Modal -->
        	<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Comment input field -->
                <div class="mb-3">
                    <label for="comment" class="form-label">Your Comment:</label>
                    <textarea required class="form-control" id="comment" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button style="color: black;"  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button style="color: black;" type="button" class="btn btn-primary" id="saveComment">Save Comment</button>
            </div>
        </div>
    </div>
</div>

        </div>
        <div class="card-body">
        	<input type="hidden" id="feedback_id"  value="{{$feedbackWithComments->id}}" name="">
            <h5 class="card-title">{{ $feedbackWithComments->title }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $feedbackWithComments->description }}</p>
            <p class="card-text"><strong>Category:</strong> {{ $feedbackWithComments->category }}</p>
           
        </div>
    </div>

<div class="card" style="margin-top: 30px;">
       
    <div class="ps-3">
        <h2>Replies</h2>
        @forelse($feedbackWithComments->activeComments as $reply)
            <div class="card mt-2">
                <div class="card-body">
                	<strong class="card-text">{{ $reply->user->name }}</strong>
                    <p class="card-text Reply"><strong>Reply:</strong>{{ $reply->comment }}</p>
                   
                    <p class="card-text"><strong>Posted at:</strong> {{ $reply->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p>No replies yet.</p>
        @endforelse
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<script>

    $('#saveComment').on('click', function() {
    	var comment = $('#comment').val();
    	var feedback_id = $('#feedback_id').val();

    	if (comment.trim() === '') {

		    $.toast({
			    text: 'Please enter a comment before submitting.',
			    position: 'top-right',
			    showHideTransition: 'fade',
			    icon: 'info',
			    hideAfter: 3000 
			});
		}
		else{

	        $.ajax({
	            url: '/reply/comment', 
	            method: 'POST', 
	            data: { 
	                feedback_id: feedback_id, 
	                comment :comment,
	                _token: '{{ csrf_token() }}'
	            },
	            success: function(response) {
	                
	                location.reload();
	                
	            },
	            error: function(xhr, status, error) {
	                
	                console.error('Error voting for feedback:', error);
	            }
	        });
       
        	$('#commentModal').modal('hide');
        }
    });
</script>


</x-app-layout>
