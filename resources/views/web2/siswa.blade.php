<h1>Menampilkan data dengan Object didalam Array</h1>

<table border>
	<tr>
		<td>NIM</td>
		<td>NAMA</td>
		<td>KELAS</td>
	</tr>
	@foreach($siswa as $r)
	<tr>
		<td>{{ $r->nim }}</td>
		<td>{{ $r->nama }}</td>
		<td>{{ $r->kelas }}</td>
	</tr>
	@endforeach
	
</table>
