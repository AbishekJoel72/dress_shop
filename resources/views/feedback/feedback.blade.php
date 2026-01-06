@extends('layouts.user.default')

@section('content')
    <div class="container">
        <style>
            .star-rating {
                display: flex;
                flex-direction: row-reverse;
                justify-content: flex-end;
                gap: 8px;
                font-size: 2rem;
            }

            .star-rating input {
                display: none;

            }

            .star-rating label {
                color: #d3d3d3;
                cursor: pointer;
                transition: color 0.2s;
            }


            .star-rating label:hover,
            .star-rating label:hover~label {
                color: #ffb400;
            }

            .star-rating input:checked~label {
                color: #ffb400;
            }
        </style>


        <form action="{{ route('feedback') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="feedbacks" value="true">
            <input type="hidden" name="id" value="{{ $feedback_list->id }}">
            <div class="card shadow-sm">
                <div class="card-header  bg-transparent ">
                    <h5 class="mb-0"> Feedback</h5>
                </div>
                <div class="card-body">

                    {{-- Subject --}}
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject"
                            required value="{{ $feedback_list->subject }}">
                    </div>

                    {{-- Rating --}}
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star1" name="rating" value="1"  {{ $feedback_list->rating == 1 ? 'checked' : '' }}>
                            <label for="star1" title="1 star"><i class="fa fa-star"></i></label>

                            <input type="radio" id="star2" name="rating" value="2"  {{ $feedback_list->rating == 2 ? 'checked' : '' }}>
                            <label for="star2" title="2 stars"><i class="fa fa-star"></i></label>

                            <input type="radio" id="star3" name="rating" value="3"  {{ $feedback_list->rating == 3 ? 'checked' : '' }}>
                            <label for="star3" title="3 stars"><i class="fa fa-star"></i></label>

                            <input type="radio" id="star4" name="rating" value="4"  {{ $feedback_list->rating == 4 ? 'checked' : '' }}>
                            <label for="star4" title="4 stars"><i class="fa fa-star"></i></label>

                            <input type="radio" id="star5" name="rating" value="5"  {{ $feedback_list->rating == 5 ? 'checked' : '' }}>
                            <label for="star5" title="5 stars"><i class="fa fa-star"></i></label>

                        </div>
                    </div>




                    {{-- Comment --}}
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" cols="6"
                            class="form-control" placeholder="Write your feedback here..."
                            required>{{ $feedback_list->comment }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-paper-plane"></i> Submit Feedback
                    </button>
                </div>
            </div>
        </form>



    </div>
    @include('layouts.user.footer')
@endsection
@section('script')
    @include('layouts.datatable')
    <script></script>
@endsection
