@extends('layouts.admin')
@section('title', 'Edit Menu - Admin')
@section('admin-title', 'Edit Menu')
@section('content')
<div class="ph">
    <div>
        <h1 class="ph-title">Edit: {{ $menu->name }}</h1>
        <p class="ph-sub">Perbarui rincian, harga, dan foto menu.</p>
    </div>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-g"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
</div>
<div style="max-width:700px;">
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="fg">
                    <label class="fl">Nama Menu <span class="req">*</span></label>
                    <input type="text" name="name" required class="fi" value="{{ old('name',$menu->name) }}">
                </div>
                <div class="fg">
                    <label class="fl">Kategori <span class="req">*</span></label>
                    <select name="category" id="cs" required onchange="hcc()" class="fi" style="cursor:pointer;">
                        <option value="Prasmanan"       {{ $menu->category=='Prasmanan'       ? 'selected':'' }}>Prasmanan</option>
                        <option value="Nasi Kotak"       {{ $menu->category=='Nasi Kotak'       ? 'selected':'' }}>Nasi Kotak</option>
                        <option value="Snack Box"        {{ $menu->category=='Snack Box'        ? 'selected':'' }}>Snack Box</option>
                        <option value="Custom / Tumpeng" {{ $menu->category=='Custom / Tumpeng' ? 'selected':'' }}>Custom / Tumpeng</option>
                    </select>
                </div>
                <div class="f2">
                    <div class="fg">
                        <label class="fl">Harga per Pack (Rp) <span class="req">*</span></label>
                        <input type="number" name="price_per_pax" required class="fi" value="{{ old('price_per_pax',$menu->price_per_pax) }}">
                    </div>
                    <div class="fg">
                        <label class="fl">Minimal Pack <span class="req">*</span></label>
                        <input type="number" name="min_pax" id="mp"
                               value="{{ old('min_pax',$menu->min_pax) }}"
                               min="{{ $menu->category==='Custom / Tumpeng' ? 1:30 }}" required class="fi">
                        <p class="fh" id="mph" style="display:{{ $menu->category==='Custom / Tumpeng'?'block':'none' }};">
                            Custom / Tumpeng: minimal bisa 1 pack.
                        </p>
                    </div>
                </div>
                <div class="fg">
                    <label class="fl">Foto Menu</label>
                    @if($menu->image)
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px; padding:10px 12px; background:var(--bg); border:1px solid var(--border); border-radius:var(--r);">
                            <img src="{{ $menu->image }}" style="width:64px; height:48px; object-fit:cover; border-radius:6px; border:1px solid var(--border);"
                                 onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=200'">
                            <div>
                                <div style="font-size:.8rem; font-weight:600;">Foto saat ini</div>
                                <div class="fh">Upload baru untuk mengganti</div>
                            </div>
                        </div>
                    @endif
                    <div class="upl" id="ua">
                        <i class="fa-solid fa-arrow-up-from-bracket" style="font-size:1.2rem; color:var(--accent); display:block; margin-bottom:5px;"></i>
                        <div style="font-weight:600; font-size:.82rem; margin-bottom:2px;">Klik untuk ganti foto</div>
                        <div class="fh">JPG, PNG, WEBP — Maks 2MB</div>
                        <input type="file" name="image" accept="image/*" onchange="pi(this)">
                    </div>
                    <div id="ip" style="display:none; margin-top:10px;">
                        <img id="pimg" style="max-width:150px; border-radius:6px; border:1px solid var(--border);">
                        <p class="fh" id="pname" style="margin-top:4px;"></p>
                    </div>
                    @error('image')<p class="fe"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>@enderror
                </div>
                <div class="fg">
                    <label class="fl">Deskripsi &amp; Rincian Lauk <span class="req">*</span></label>
                    <textarea name="description" rows="4" required class="ft">{{ old('description',$menu->description) }}</textarea>
                </div>
                <div class="fg">
                    <label class="fck">
                        <input type="checkbox" name="is_available" value="1" {{ $menu->is_available ? 'checked':'' }}>
                        <div>
                            <div class="fck-lbl">Tersedia untuk Dipesan</div>
                            <div class="fh" style="margin-top:1px;">Menu akan tampil di katalog pelanggan</div>
                        </div>
                    </label>
                </div>
                <div class="fg">
                    <label class="fck">
                        <input type="checkbox" name="is_bestseller" value="1" {{ $menu->is_bestseller ? 'checked':'' }}>
                        <div>
                            <div class="fck-lbl">Tandai sebagai Bestseller ⭐</div>
                            <div class="fh" style="margin-top:1px;">Tampil di 6 menu utama homepage</div>
                        </div>
                    </label>
                </div>
                <div style="display:flex; gap:10px; padding-top:4px;">
                    <button type="submit" class="btn btn-p btn-lg"><i class="fa-solid fa-pen"></i> Update Menu</button>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-r btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function hcc(){var c=document.getElementById('cs').value,m=document.getElementById('mp'),h=document.getElementById('mph'),t=c==='Custom / Tumpeng';m.min=t?1:30;h.style.display=t?'block':'none';if(t&&parseInt(m.value)<1)m.value=1;}
function pi(i){if(i.files&&i.files[0]){var r=new FileReader();r.onload=function(e){document.getElementById('pimg').src=e.target.result;document.getElementById('pname').textContent=i.files[0].name;document.getElementById('ip').style.display='block';};r.readAsDataURL(i.files[0]);}}
</script>
@endsection
