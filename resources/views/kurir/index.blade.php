<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Kurir
            </div>
            <div class="card-body">
                <div class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kurir</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>
                                <a href="{{ route('kurir.create') }}" class="btn btn-primary btn-sm"> Tambah Kurir</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kurirs as $v)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->email }}</td>
                            <td>{{ $v->no_hp }}</td>
                            <td>{{ $v->alamt }}</td>
                        </tr>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>