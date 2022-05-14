@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        @can('qrcode_create')
            <a href="{{ route('qrcode.new') }}" class="btn btn-primary btn-sm">ADD</a>
        @endcan

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">QrCode</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $qrcode)
                    <tr>
                        <td>{{ $qrcode->title }}</td>
                        <td>
                            <a style="cursor: pointer" onclick="PrintImage('{{ url('storage/' . $qrcode->qrcode) }}')">
                                <img src="{{ url('storage/' . $qrcode->qrcode) }}" alt="" width="100px">
                            </a>
                        </td>
                        <td>
                            @can('qrcode_edit', $qrcode)
                                <a href="{{ route('qrcode.edit', $qrcode->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan

                            @can('qrcode_delete', $qrcode)
                                <a href="{{ route('qrcode.remove', $qrcode->id) }}" class="btn btn-sm btn-danger">Remove</a>
                            @endcan

                        </td>
                    </tr>
                @empty
                    nothing to list
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function PrintImage(source) {
            var Pagelink = "about:blank";
            var pwa = window.open(Pagelink, "_new");
            pwa.document.open();
            pwa.document.write(ImagetoPrint(source));
            pwa.document.close();
        }

        function ImagetoPrint(source) {
            return "<html><head><scri" + "pt>function step1(){\n" +
                "setTimeout('step2()', 10);}\n" +
                "function step2(){window.print();window.close()}\n" +
                "</scri" + "pt></head><body onload='step1()'>\n" +
                "<img src='" + source + "' /></body></html>";
        }
    </script>
@stop
