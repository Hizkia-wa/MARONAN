<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk - MARONAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen p-8">

    <h1 class="text-3xl font-bold text-green-700 mb-6">
        Daftar Produk
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Nama Produk</th>
                    <th class="p-3 text-left">Petani</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Dibuat</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr class="border-b">

                        <td class="p-3 font-semibold">
                            {{ $product->name }}
                        </td>

                        <td class="p-3">
                            {{ $product->user->name ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $product->category }}
                        </td>

                        <td class="p-3 text-green-600 font-semibold">
                            Rp {{ number_format($product->price,0,',','.') }}
                        </td>

                        <td class="p-3 text-sm text-gray-500">
                            {{ $product->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3">

                            <form method="POST"
                                  action="{{ route('admin.produk.destroy',$product->id) }}"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Belum ada produk
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>

</body>
</html>
