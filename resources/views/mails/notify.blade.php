@extends('mails.mail')

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{$conf->name}}</h1>
            <hr>

            <p>Dear Authors ({{App\User::getFullName($paper->user)}});</p>
            <p>The review process for {{$conf->name}} has been completed. Based on the recommendations of the reviewers and the Technical Program Committee, we are pleased to inform you that your paper.</p>
            <br>
            <p>Paper ID: {{$paper->id}}, entitled: "{{$paper->title}}" has been {{$paper->decision}}</p>
            <p>
                Presentation Type:
                @if($paper->presentation == 1)
                    Oral Presentation
                @else
                    Poster Presentation
                @endif
            </p>
            @if($paper->decision == "Accepted")
                <br>
                <p>
                    You are cordially invited to present the paper at {{$conf->name}} that to be held on {{$conf->conference_start_date}} - {{$conf->conference_end_date}}.
                </p>
                <br>
                <p>
                    <strong>(Important)</strong>
                    Please continue the following steps for your manuscript to be published.
                </p>
                <br>
                <ol>
                    <li>EDIT your paper according to the suggestions of reviewers, strictly follow the recommended paper format. The reviewer's comments can be found in your paper management page. Please write and submit your response to comments of reviewers (if required).</li>
                    <li>Please be aware of plagiarism issue. Normal acceptance of ext similarity is les than 25%.</li>
                    <li>Please submit the final version of the revised manuscript (camera ready) with in {{$conf->camera_deadline}}.</li>
                    <li>Please be reminded that at least ONE authors of each accepted paper MUST register for the conference in order for the paper to be included in the program and conference proceedings.</li>
                    <li>For paper registration, download and fill all the documents including the copyright transfer form, the speaker biography, and the response to comments of reviewers. Please also submit your proof of sponsoring society membership or studentship (if required).</li>
                    <li>Be reminded that the early bird registration date is {{$conf->pre_regis}}. Late registration can affect the higher registration fee.</li>
                </ol>
                <br>
                <p>This notification serves as our formal acceptance of your paper as well as an invitation to present your work at {{$conf->name}}/</p>
                <p>Should have and query, please contact {{$conf->name}} Secretariat via admin@conference-center.org.</p>
                <p>We look forward to seeing you in soon.</p>
                <br>
                <p>Sincerely,</p>
                <p>{{$conf->name}} Technical Program Committee</p>

                <a href="http://conference-center.org/{{$conf->url}}">http://conference-center.org/{{$conf->url}}</a>
            @endif
        </div>
    </div>
@endsection
