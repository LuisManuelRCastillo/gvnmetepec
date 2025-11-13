<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - GranVM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white-700 text-white p-4 shadow">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
             <img style="max-width: 100px;" src="/assets/img/granvn-logosf.png" alt="">
            <h1 style="color: #4A5568;" class="text-lg font-semibold">Administración de Inventario</h1>
            <a href="{{ url('/') }}" class="bg-green-600 text-white px-5 py-2.5 rounded-lg rounded hover:bg-green-700">Regresar a ventas</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto mt-8 p-6 bg-white shadow-lg rounded">

        {{-- Mensajes --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-6">
                 {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario de nuevo producto --}}
        <h2 class="text-2xl font-bold mb-6 text-green-700">Nuevo Producto</h2>

        <form action="{{ route('inventory.store') }}" method="POST" class="grid grid-cols-2 gap-4 mb-10">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Código</label>
                <input name="code" value="{{ old('code') }}" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Nombre</label>
                <input name="name" value="{{ old('name') }}" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Categoría</label>
                <select name="category_id" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Tamaño</label>
                <input name="size" value="{{ old('size') }}" class="w-full border rounded p-2 focus:ring focus:ring-green-200">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Stock inicial</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="w-full border rounded p-2 focus:ring focus:ring-green-200">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Stock mínimo</label>
                <input type="number" name="min_stock" value="{{ old('min_stock', 5) }}" min="0" class="w-full border rounded p-2 focus:ring focus:ring-green-200">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Precio costo</label>
                <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price') }}" min="0" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Precio venta</label>
                <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price') }}" min="0" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-semibold mb-1">Descripción</label>
                <textarea name="description" rows="3" class="w-full border rounded p-2 focus:ring focus:ring-green-200">{{ old('description') }}</textarea>
            </div>

            <div class="col-span-2 flex justify-end">
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 transition">
                    Guardar producto
                </button>
            </div>
        </form>

        {{-- Tabla de productos existentes --}}
        <h2 class="text-2xl font-bold mb-4 text-green-700">Lista de Productos</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-3 py-2 border">ID</th>
                        <th class="px-3 py-2 border">Código</th>
                        <th class="px-3 py-2 border">Nombre</th>
                        <th class="px-3 py-2 border">Categoría</th>
                        <th class="px-3 py-2 border">Stock</th>
                        <th class="px-3 py-2 border">Precio Venta</th>
                        <th class="px-3 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">{{ $p->id }}</td>
                            <td class="border px-3 py-2">{{ $p->code }}</td>
                            <td class="border px-3 py-2">{{ $p->name }}</td>
                            <td class="border px-3 py-2">{{ $p->category->name ?? '-' }}</td>
                            <td class="border px-3 py-2 text-center">{{ $p->stock }}</td>
                            <td class="border px-3 py-2 text-right">${{ number_format($p->sale_price, 2) }}</td>
                            <td class="border px-3 py-2 text-center">
                                <button
    type="button"
    class="bg-blue-600 px-5 py-2.5 rounded-lg text-white font-semibold hover:underline"
    onclick='openEditModal(@json($p))'>
     Editar
</button>
                                <form action="{{ route('inventory.destroy', $p) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar este producto?')">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-600 px-5 py-2.5 rounded-lg text-white font-semibold hover:underline ml-2">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4 text-gray-500">No hay productos registrados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
            <!-- Modal para editar producto -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-green-700">Editar Producto</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Código</label>
                        <input type="text" name="code" id="edit_code" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nombre</label>
                        <input type="text" name="name" id="edit_name" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Categoría</label>
                        <select name="category_id" id="edit_category_id" class="w-full border rounded p-2 focus:ring focus:ring-green-200" required>
                            <option value="">Seleccione</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Tamaño</label>
                        <input type="text" name="size" id="edit_size" class="w-full border rounded p-2 focus:ring focus:ring-green-200">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Stock</label>
                        <input type="number" name="stock" id="edit_stock" class="w-full border rounded p-2 focus:ring focus:ring-green-200" min="0">
                    </div>
                      <div>
                        <label class="block text-sm font-semibold mb-1">Precio venta</label>
                        <input type="number" step="0.01" name="cost_price" id="edit_cost_price" class="w-full border rounded p-2 focus:ring focus:ring-green-200" min="0">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Precio venta</label>
                        <input type="number" step="0.01" name="sale_price" id="edit_sale_price" class="w-full border rounded p-2 focus:ring focus:ring-green-200" min="0">
                    </div>
                </div>

                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    </main>

    <footer class="text-center text-sm text-gray-500 py-6">
        © {{ date('Y') }} LuraDev. Todos los derechos reservados.
    </footer>
<script>
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    function openEditModal(product) {
        modal.classList.remove('hidden');

        // Rellenar datos del producto
        document.getElementById('edit_id').value = product.id;
        document.getElementById('edit_code').value = product.code;
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_category_id').value = product.category_id;
        document.getElementById('edit_size').value = product.size ?? '';
        document.getElementById('edit_stock').value = product.stock ?? 0;
        document.getElementById('edit_cost_price').value = product.cost_price ?? 0;
        document.getElementById('edit_sale_price').value = product.sale_price ?? 0;

        // Actualizar acción del formulario
        form.action = `"/inventory/${product.id}`;
    }

    function closeModal() {
        modal.classList.add('hidden');
    }
</script>

</body>
</html>
