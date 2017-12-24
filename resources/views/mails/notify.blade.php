@extends('mails.mail')

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{$conf->name}}</h1>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non risus condimentum, tristique nibh nec, auctor neque. Sed urna leo, dignissim mollis ultricies id, luctus sit amet nulla. Nulla condimentum consequat sapien. Sed pulvinar, felis quis bibendum iaculis, mi ipsum faucibus nunc, id porta massa nibh et lacus. Nulla at aliquet nisl, tempus finibus purus. Maecenas congue rhoncus erat eget gravida. Nullam pulvinar lectus augue, id facilisis tellus commodo eget.</p>

            <p>Integer volutpat interdum augue, sed consequat nunc venenatis quis. Donec dignissim sollicitudin consequat. Nulla facilisi. Suspendisse ipsum dui, ullamcorper non ipsum viverra, mattis pulvinar nunc. Nulla cursus libero eget lacinia condimentum. Suspendisse aliquet sapien nec purus dapibus, quis cursus odio faucibus. Curabitur imperdiet felis id mi sodales, et suscipit ex mattis. Maecenas tristique nisl id volutpat congue. Morbi rhoncus magna eget neque pellentesque dapibus. Integer libero ipsum, finibus eget gravida quis, posuere in elit. Pellentesque non ex finibus, convallis neque sit amet, malesuada ex. Vestibulum congue urna sed dolor suscipit, in ullamcorper orci viverra. Sed nunc ante, imperdiet ac sapien vitae, lacinia vestibulum ipsum. Duis interdum magna sapien, nec vulputate est sagittis in. Sed eleifend bibendum aliquet. Praesent fermentum, quam eget pulvinar dictum, justo augue interdum ligula, iaculis ullamcorper quam ipsum ut nibh.</p>

            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                <li>Fusce non risus condimentum, tristique nibh nec, auctor neque.</li>
                <li>Sed urna leo, dignissim mollis ultricies id, luctus sit amet nulla.</li>
            </ul>
        </div>
    </div>
@endsection
