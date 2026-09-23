@extends('layouts.admin')
@section('title', 'Tambah Menu - Admin')
@section('admin-title', 'Tambah Menu')
@section('content')
<div class="ph">
    <div class="ph-row">
        <div class="ph-badge"><i class="fa-solid fa-plus"></i></div>
        <div>
            <h1 class="ph-title">Tambah Menu Katering Baru</h1>
            <p class="ph-sub">Isi formulir untuk menambahkan paket ke katalog.</p>
        </div>
    </div>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-g"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
</div>
<div class="menu-form-grid">
    <div class="box">
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" id="menuForm">
            @csrf

            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-utensils"></i> Informasi Menu</div>
                <div class="fg">
                    <label class="fl">Nama Menu <span class="req">*</span></label>
                    <input type="text" name="name" id="fName" required class="fi"
                           placeholder="Contoh: Paket Prasmanan Royal Sultan" value="{{ old('name') }}" oninput="updatePreview()">
                </div>
                <div class="fg" style="margin-bottom:0;">
                    <label class="fl">Kategori <span class="req">*</span></label>
                    <select name="category" id="cs" required onchange="hcc();updatePreview();" class="fi" style="cursor:pointer;">
                        <option value="Prasmanan"       {{ old('category')=='Prasmanan'       ? 'selected':'' }}>Prasmanan</option>
                        <option value="Nasi Kotak"       {{ old('category')=='Nasi Kotak'       ? 'selected':'' }}>Nasi Kotak</option>
                        <option value="Snack Box"        {{ old('category')=='Snack Box'        ? 'selected':'' }}>Snack Box</option>
                        <option value="Custom / Tumpeng" {{ old('category')=='Custom / Tumpeng' ? 'selected':'' }}>Custom / Tumpeng</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-tags"></i> Harga &amp; Stok</div>
                <div class="f2" style="margin-bottom:0;">
                    <div class="fg">
                        <label class="fl">Harga per Pack (Rp) <span class="req">*</span></label>
                        <input type="number" name="price_per_pax" id="fPrice" required class="fi" placeholder="75000" value="{{ old('price_per_pax') }}" oninput="updatePreview()">
                    </div>
                    <div class="fg">
                        <label class="fl">Minimal Pack <span class="req">*</span></label>
                        <input type="number" name="min_pax" id="mp" value="{{ old('min_pax',30) }}" min="30" required class="fi" oninput="updatePreview()">
                        <p class="fh" id="mph" style="display:none;">Custom / Tumpeng: minimal bisa 1 pack.</p>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-image"></i> Foto Menu</div>
                <div class="fg" style="margin-bottom:0;">
                    <div class="upl" id="ua">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.3rem; color:var(--accent); display:block; margin-bottom:6px;"></i>
                        <div style="font-weight:600; font-size:.84rem; margin-bottom:2px;">Klik untuk upload foto</div>
                        <div class="fh">JPG, PNG, WEBP — Maks 2MB</div>
                        <input type="file" name="image" accept="image/*" onchange="pi(this)">
                    </div>
                    <div id="ip" style="display:none; margin-top:10px;">
                        <img id="pimg" style="max-width:150px; border-radius:6px; border:1px solid var(--border);">
                        <p class="fh" id="pname" style="margin-top:4px;"></p>
                    </div>
                    @error('image')<p class="fe"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>@enderror
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-align-left"></i> Deskripsi</div>
                <div class="fg" style="margin-bottom:0;">
                    <label class="fl">Rincian Lauk &amp; Menu <span class="req">*</span></label>
                    <textarea name="description" rows="4" required class="ft"
                              placeholder="Rincian lauk pauk, dessert, dan minuman...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-sliders"></i> Pengaturan Tampilan</div>
                <div class="fg">
                    <label class="fck">
                        <input type="checkbox" name="is_available" id="fAvail" value="1" checked onchange="updatePreview()">
                        <div>
                            <div class="fck-lbl">Tersedia untuk Dipesan</div>
                            <div class="fh" style="margin-top:1px;">Menu akan tampil di katalog pelanggan</div>
                        </div>
                    </label>
                </div>
                <div class="fg" style="margin-bottom:0;">
                    <label class="fck">
                        <input type="checkbox" name="is_bestseller" id="fBest" value="1" {{ old('is_bestseller') ? 'checked':'' }} onchange="updatePreview()">
                        <div>
                            <div class="fck-lbl">Tandai sebagai Bestseller ⭐</div>
                            <div class="fh" style="margin-top:1px;">Ditampilkan di menu utama</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-section" style="border-bottom:none; display:flex; gap:10px;">
                <button type="submit" class="btn btn-p btn-lg"><i class="fa-solid fa-floppy-disk"></i> Simpan Menu</button>
                <a href="{{ route('admin.menus.index') }}" class="btn btn-r btn-lg">Batal</a>
            </div>
        </form>
    </div>

    <div class="menu-preview-col">
        <div class="menu-preview-label"><i class="fa-solid fa-eye" style="margin-right:5px;"></i>Pratinjau Katalog</div>
        <div class="mp-card">
            <div class="mp-media">
                <img id="mpImg" src="" alt="" style="display:none;">
                <div class="mp-media-empty" id="mpImgEmpty">
                    <i class="fa-solid fa-image"></i>
                    <span>Belum ada foto</span>
                </div>
                <span class="mp-star" id="mpStar" style="display:none;"><i class="fa-solid fa-star"></i> Bestseller</span>
            </div>
            <div class="mp-body">
                <div class="mp-top">
                    <div class="mp-title" id="mpName">Nama menu kamu</div>
                    <div class="mp-price" id="mpPrice">Rp 0</div>
                </div>
                <div class="mp-meta">
                    <span class="mp-tag" id="mpCat">Prasmanan</span>
                    <span class="mp-minpax"><i class="fa-regular fa-clock" style="font-size:.6rem;"></i> Min. <span id="mpMinpax">30</span> pack</span>
                </div>
                <div class="mp-unavail" id="mpUnavail" style="display:none;">Tidak tersedia untuk dipesan</div>
            </div>
        </div>
    </div>
</div>
<script>
function hcc(){var c=document.getElementById('cs').value,m=document.getElementById('mp'),h=document.getElementById('mph'),t=c==='Custom / Tumpeng';m.min=t?1:30;h.style.display=t?'block':'none';if(t&&parseInt(m.value)<1)m.value=1;}
function pi(i){if(i.files&&i.files[0]){var r=new FileReader();r.onload=function(e){document.getElementById('pimg').src=e.target.result;document.getElementById('pname').textContent=i.files[0].name;document.getElementById('ip').style.display='block';document.getElementById('mpImg').src=e.target.result;document.getElementById('mpImg').style.display='block';document.getElementById('mpImgEmpty').style.display='none';};r.readAsDataURL(i.files[0]);}}
var ua=document.getElementById('ua');
ua.addEventListener('dragover',function(e){e.preventDefault();ua.classList.add('drag');});
ua.addEventListener('dragleave',function(){ua.classList.remove('drag');});

function updatePreview(){
    var name = document.getElementById('fName').value.trim();
    document.getElementById('mpName').textContent = name || 'Nama menu kamu';

    var price = parseInt(document.getElementById('fPrice').value || 0, 10);
    document.getElementById('mpPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');

    document.getElementById('mpCat').textContent = document.getElementById('cs').value;
    document.getElementById('mpMinpax').textContent = document.getElementById('mp').value || 30;

    document.getElementById('mpStar').style.display = document.getElementById('fBest').checked ? 'flex' : 'none';
    document.getElementById('mpUnavail').style.display = document.getElementById('fAvail').checked ? 'none' : 'block';
}
updatePreview();
</script>
@endsection
