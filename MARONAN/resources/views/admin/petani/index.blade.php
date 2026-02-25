<!DOCTYPE html>
<html>
<head>
    <title>Daftar Petani - MARONAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen p-8">

    <h1 class="text-3xl font-bold text-green-700 mb-6">
        Daftar Petani
    </h1>

    <!-- Filter -->
    <div class="mb-6">
        <form method="GET" class="flex gap-4">
            <select name="status" class="border p-2 rounded">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Filter
            </button>
        </form>
    </div>

    <!-- Tabel -->
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Desa</th>
                    <th class="p-3 text-left">No WA</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petanis as $petani)
                    <tr class="border-b">
                        <td class="p-3">{{ $petani->name }}</td>
                        <td class="p-3">{{ $petani->email }}</td>
                        <td class="p-3">{{ $petani->village }}</td>
                        <td class="p-3">{{ $petani->phone }}</td>

                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-white
                                {{ $petani->verification_status == 'approved' ? 'bg-green-500' :
                                   ($petani->verification_status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                {{ ucfirst($petani->verification_status) }}
                            </span>
                        </td>

                        <td class="p-3 flex gap-2">

                            @if($petani->verification_status == 'pending')

                            <form method="POST" action="{{ route('admin.petani.approve', $petani->id) }}">
                                @csrf
                                <button class="bg-green-600 text-white px-3 py-1 rounded">
                                    Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.petani.reject', $petani->id) }}">
                                @csrf
                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    Reject
                                </button>
                            </form>

                            @else
                                <span class="text-gray-400 text-sm">
                                    Tidak ada aksi
                                </span>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Belum ada petani terdaftar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $petanis->links() }}
    </div>

</div>

</body>
</html>