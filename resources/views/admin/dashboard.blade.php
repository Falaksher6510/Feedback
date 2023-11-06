<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
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
                                    <div class="card-header"><span>Feedbacks</span></div>

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
                    
                                                            @if($feedback->active)
                                                             <button  id="vote-{{$feedback->id}}" class="btn btn-primary btn-sm" onclick="FeedbackEnable({{ $feedback->id }} , 0)">Active</button>
                                                            @else

                                                            <button  class="btn btn-primary btn-sm" onclick="FeedbackEnable({{ $feedback->id }} ,1)">Inactive</button>   

                                                            @endif

                                                            <a href="{{ route('admin.feedback.view', $feedback->id) }}" class="btn btn-success btn-sm">View</a>

                                                            <form style="display: inline-block;"  action="{{ route('feedback.destroy', $feedback->id) }}" method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                 <button class="btn btn-danger btn-sm">Delete </button>
                                                            </form>


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
    <script type="text/javascript">
     function FeedbackEnable(feedbackId ,state) {

        debugger

   
                
        


        $.ajax({
            url: 'feedback/Enable', 
            method: 'POST', 
            data: { 
                feedback_id: feedbackId,
                state: state, 
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {

                    location.reload();



            },
            error: function(xhr, status, error) {
                
                console.error('Error voting for feedback:', error);
            }
        });
    }
    </script>

</x-admin-layout>
