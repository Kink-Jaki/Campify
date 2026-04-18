@extends('layouts.admin')
@section('title', 'Kategori')
@section('content')

<style>
    :root {
        --forest-dark: #1b4332;
        --forest-medium: #2d6a4f;
        --forest-light: #40916c;
        --nature-accent: #d8f3dc;
        --earth-brown: #bc6c25;
        --sunset-orange: #e76f51;
        --cream: #fefae0;
        --warning-gold: #ffc107;
    }

    /* Page Header */
    .page-header-kategori {
        background: linear-gradient(135deg, var(--forest-dark) 0%, var(--forest-medium) 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .page-header-kategori::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05));
    }

    .page-title-kategori {
        color: white;
        font-weight: 800;
        font-size: 1.75rem;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .title-icon-kategori {
        width: 52px;
        height: 52px;
        background: rgba(255, 193, 7, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    /* Add Category Card */
    .add-category-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.08);
        overflow: hidden;
        height: 100%;
    }

    .card-header-kategori {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        font-weight: 700;
        padding: 20px 24px;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
        border: none;
    }

    .card-body-kategori {
        padding: 28px;
    }

    /* Form Styling */
    .input-group-custom {
        position: relative;
    }

    .form-control-kategori {
        border: 2px solid #e9ecef;
        border-radius: 14px 0 0 14px;
        padding: 14px 18px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fafbfc;
        border-right: none;
    }

    .form-control-kategori:focus {
        border-color: var(--forest-medium);
        background: white;
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        outline: none;
    }

    .btn-tambah-kategori {
        background: linear-gradient(135deg, var(--warning-gold), #ff9800);
        border: 2px solid var(--warning-gold);
        border-left: none;
        color: var(--forest-dark);
        font-weight: 700;
        padding: 14px 24px;
        border-radius: 0 14px 14px 0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-tambah-kategori:hover {
        background: linear-gradient(135deg, #ffca28, #ffa000);
        transform: translateX(2px);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .invalid-feedback-kategori {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        padding: 8px 12px;
        background: #ffebee;
        border-radius: 8px;
    }

    /* List Card */
    .list-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.08);
        overflow: hidden;
        height: 100%;
    }

    /* Custom Table */
    .table-kategori {
        margin: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-kategori thead th {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 20px 24px;
        border: none;
    }

    .table-kategori tbody tr {
        transition: all 0.2s ease;
    }

    .table-kategori tbody tr:hover {
        background: var(--nature-accent);
        transform: scale(1.002);
    }

    .table-kategori tbody td {
        padding: 20px 24px;
        vertical-align: middle;
        border-bottom: 1px solid #edf2f7;
        font-size: 0.95rem;
    }

    .table-kategori tbody tr:last-child td {
        border-bottom: none;
    }

    /* Category Name Cell */
    .category-name-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        color: var(--forest-dark);
    }

    .category-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    /* Count Badge */
    .count-badge {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .count-badge i {
        font-size: 0.875rem;
    }

    /* Action Buttons */
    .action-group-kategori {
        display: flex;
        gap: 8px;
    }

    .btn-action-kategori {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.875rem;
    }

    .btn-edit-kategori {
        background: linear-gradient(135deg, #fff3e0, #ffe0b2);
        color: #e65100;
    }

    .btn-edit-kategori:hover {
        background: linear-gradient(135deg, #ffe0b2, #ffcc80);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(230, 81, 0, 0.2);
        color: #e65100;
    }

    .btn-delete-kategori {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
    }

    .btn-delete-kategori:hover {
        background: linear-gradient(135deg, #ffcdd2, #ef9a9a);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(198, 40, 40, 0.2);
        color: #c62828;
    }

    /* Empty State */
    .empty-state-kategori {
        text-align: center;
        padding: 48px 24px;
    }

    .empty-icon-kategori {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 2rem;
        color: #a0aec0;
    }

    /* Modal Styling */
    .modal-content-kategori {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .modal-header-kategori {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        border: none;
        padding: 20px 24px;
    }

    .modal-title-kategori {
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-close-custom {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        padding: 8px;
        opacity: 1;
        transition: all 0.3s ease;
    }

    .btn-close-custom:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .modal-body-kategori {
        padding: 24px;
    }

    .form-control-modal {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fafbfc;
        margin-bottom: 16px;
    }

    .form-control-modal:focus {
        border-color: var(--forest-medium);
        background: white;
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        outline: none;
    }

    .btn-simpan-modal {
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border: none;
        color: white;
        font-weight: 700;
        padding: 14px 24px;
        border-radius: 12px;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-simpan-modal:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45, 106, 79, 0.3);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header-kategori {
            padding: 20px;
        }

        .page-title-kategori {
            font-size: 1.5rem;
        }

        .table-kategori thead {
            display: none;
        }

        .table-kategori tbody tr {
            display: block;
            margin-bottom: 16px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background: white;
        }

        .table-kategori tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #edf2f7;
        }

        .table-kategori tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            color: var(--forest-dark);
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .table-kategori tbody td:last-child {
            border-bottom: none;
        }

        .action-group-kategori {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header-kategori">
    <h4 class="page-title-kategori">
        <span class="title-icon-kategori">🏷️</span>
        <span>Kelola Kategori</span>
    </h4>
</div>

<div class="row g-4">
    <!-- Add Category Card -->
    <div class="col-md-5">
        <div class="card add-category-card">
            <div class="card-header-kategori">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Tambah Kategori Baru</span>
            </div>
            <div class="card-body-kategori">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="input-group input-group-custom">
                        <input type="text" name="nama_kategori" 
                            class="form-control form-control-kategori @error('nama_kategori') is-invalid @enderror" 
                            placeholder="Masukkan nama kategori..." 
                            required>
                        <button class="btn btn-tambah-kategori" type="submit">
                            <i class="bi bi-plus-lg"></i>
                            <span>Tambah</span>
                        </button>
                    </div>
                    @error('nama_kategori')
                        <div class="invalid-feedback-kategori">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </form>
            </div>
        </div>
    </div>

    <!-- List Category Card -->
    <div class="col-md-7">
        <div class="card list-card">
            <div class="card-header-kategori">
                <i class="bi bi-list-ul"></i>
                <span>Daftar Kategori</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-kategori">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $k)
                        <tr>
                            <td data-label="No">{{ $loop->iteration }}</td>
                            <td data-label="Nama Kategori">
                                <div class="category-name-cell">
                                    <div class="category-icon">
                                        <i class="bi bi-folder-fill"></i>
                                    </div>
                                    <span>{{ $k->nama_kategori }}</span>
                                </div>
                            </td>
                            <td data-label="Jumlah Barang">
                                <span class="count-badge">
                                    <i class="bi bi-box-seam"></i>
                                    {{ $k->barang_count }} Barang
                                </span>
                            </td>
                            <td data-label="Aksi">
                                <div class="action-group-kategori">
                                    <button class="btn-action-kategori btn-edit-kategori" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $k->id }}"
                                            title="Edit Kategori">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua barang dalam kategori ini akan kehilangan kategori.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action-kategori btn-delete-kategori" title="Hapus Kategori">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-content-kategori">
                                    <div class="modal-header modal-header-kategori">
                                        <h6 class="modal-title modal-title-kategori">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit Kategori
                                        </h6>
                                        <button type="button" class="btn-close btn-close-white btn-close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modal-body-kategori">
                                        <form action="{{ route('admin.kategori.update', $k) }}" method="POST">
                                            @csrf @method('PUT')
                                            <label class="form-label fw-bold mb-2" style="color: var(--forest-dark);">
                                                <i class="bi bi-tag-fill me-1"></i>Nama Kategori
                                            </label>
                                            <input type="text" name="nama_kategori" 
                                                class="form-control form-control-modal" 
                                                value="{{ $k->nama_kategori }}" 
                                                placeholder="Masukkan nama kategori..."
                                                required>
                                            <button type="submit" class="btn btn-simpan-modal">
                                                <i class="bi bi-check-lg"></i>
                                                Simpan Perubahan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state-kategori">
                                    <div class="empty-icon-kategori">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Belum Ada Kategori</h6>
                                    <p class="text-muted small mb-0">Silakan tambahkan kategori baru di form sebelah kiri.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection