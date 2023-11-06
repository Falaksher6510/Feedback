
<x-admin-layout>

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
       
        <div class="card-header"><span>Feedback Detail</span></div>
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
        @forelse($feedbackWithComments->comments as $reply)
            <div class="card mt-2">
                <div class="card-body" style="padding: -5px !important;">
                	<strong class="card-text">{{ $reply->user->name }}</strong>
                    <p class="card-text Reply"><strong>Reply:</strong>{{ $reply->comment }}</p> 
                   
                    <p class="card-text"><strong>Posted at:</strong> {{ $reply->created_at->diffForHumans() }}</p>
                </div>
                @if($reply->active)
                <div class="card-body" >
                <button  class="btn btn-primary btn-sm" onclick="commentenable ({{ $reply->id }} ,0)">active</button>   
                </div>
                @else
                <div class="card-body" >
                <button  class="btn btn-primary btn-sm" onclick="commentenable({{ $reply->id }} ,1)">Inactive</button>   
                </div>
                @endif
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
    function commentenable (CommentId ,state) {

       

        $.ajax({
            url: 'comment/enable', 
            method: 'POST', 
            data: { 
                CommentId: CommentId,
                state:state, 
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                    location.reload();


            },
            error: function(xhr, status, error) {
                
            }
        });
    }
</script>
</x-admin-layout>