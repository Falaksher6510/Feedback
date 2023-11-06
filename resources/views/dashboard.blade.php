<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                
                                <div class="card">
                                    <div class="card-header"><span>Feedbacks</span><a href="{{ route('feedback.create') }}" class="float-right btn btn-primary "   >Add New Feedback</a href="{{ route('feedback.create') }}"></div>

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table id="agent_datatable" class="table table-bordered display" style="width:100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        
                                                        <th>Title</th>
                                                        <th>category</th>
                                                        <th>Vote Count</th>
                                                        <th>User</th>
                                                        <th>Action</th>

                                                        
                                                        
                                                    </tr>
                                                </thead> 

                                                <tbody id="feedback-table">
                                                    @foreach($feedbacks as $key => $feedback)
                                                    <tr>

                                                        <th>{{ $feedback->title }}</th>
                                                        <th>{{ $feedback->category }}</th>
                                                        <th id="votecount-{{$feedback->id}}">{{count($feedback->votes)}}</th>
                                                        <th>Falak Sher</th>
                                                        <th>
                    
                                                            @if($feedback->votes->where('user_id', auth()->id())->count() == 0)
                                                             <button  id="vote-{{$feedback->id}}" class="btn btn-primary btn-sm" onclick="voteFeedback({{ $feedback->id }})">Vote</button>

                                                            <!-- View Button -->
                                                            <a href="{{ route('comment.create', $feedback->id) }}" class="btn btn-success btn-sm">View</a>

                                                            @else

                                                            <button disabled class="btn btn-primary btn-sm" onclick="voteFeedback({{ $feedback->id }})">Vote</button>

                                                            <!-- View Button -->
                                                            <a href="{{ route('comment.create', $feedback->id) }}" class="btn btn-success btn-sm">View</a>

                                                            @endif
                                                        </th>
                                                    </tr>

                                                    @endforeach
                                                 
                                                </tbody> 
                                               
                                            </table>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function voteFeedback(feedbackId) {

   
                
        


        $.ajax({
            url: '/feedback/vote', 
            method: 'POST', 
            data: { 
                feedback_id: feedbackId, 
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {

                votecount = 'votecount-'+feedbackId;

                count = $("#"+votecount).html();
                $($("#"+votecount)).html("");


                $($("#"+votecount)).html(count +1);
                $('#vote-'+feedbackId).prop('disabled', true);




                
                
                
            },
            error: function(xhr, status, error) {
                
                console.error('Error voting for feedback:', error);
            }
        });
    }
</script>
</x-app-layout>
