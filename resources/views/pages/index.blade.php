@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h2>All of your counted notes</h2>
        </div>
        <div class="col-lg-4 text-right">
            <a class="btn btn-primary" href="{{route('addPage')}}">New counting note</a>
        </div>
    </div>

    <form method="get" class="mt-4 mb-4 form-inline">
        <input type="text" class="form-control mr-1" name="keyword" placeholder="Keyword to search" value="{{request('keyword', '')}}">
        <input type="text" class="form-control mr-1 dateFrom" name="date_from" placeholder="Created From" value="{{request('date_from', '')}}">
        <input type="text" class="form-control mr-1 dateTo" name="date_to" placeholder="Created To" value="{{request('date_to', '')}}">
        <button class="btn btn-secondary">Filter</button>
    </form>

    <div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Total Time</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                    <tr>
                        <td>{{$note->title}}</td>
                        <td>{{$note->description}}</td>
                        <td>{{date('i:s', $note->time)}}</td>
                        <td>{{$note->created_at->format("d/m/Y H:i")}}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach

                @if($notes->count() == 0)
                    <tr>
                        <td colspan="5">Empty result</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="text-center">
            {!! $notes->appends(request()->all())->links() !!}
        </div>
    </div>
@endsection