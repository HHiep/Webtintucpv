<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<div class="card-body">
    <h1 class="card-title">List Notification</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Image</th>
                    {{-- <th><a class="btn btn-info" href="{{ route('admin.product.add') }}">Thêm</a></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($dataAll as $index => $item)
                    @php
                        $param = [
                            'id' => $item->id,
                            
                        ];
                    @endphp
                    {{-- Mỗi sản phẩm --}}
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td> <img src="{{ $item->image }}" alt="" /></td>
                        <td>{{ $item->post }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('confirmAdmin', $param) }}"> confirm Admin
                                </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
