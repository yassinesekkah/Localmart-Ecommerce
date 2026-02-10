@props([
    'product' => null,
    'categories',
    'action',
    'method' => 'POST',
    'button' => 'Save',
])

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Syne:wght@600;700&display=swap');

    .pf-form * { box-sizing: border-box; }

    .pf-form {
        font-family: 'DM Sans', sans-serif;
        background: #ffffff;
        border: 1px solid #e8e4f0;
        border-radius: 20px;
        padding: 2.5rem;
        width: 100%;
        max-width: 640px;
        box-shadow: 0 4px 24px rgba(99, 82, 180, 0.07), 0 1px 4px rgba(0,0,0,0.04);
    }

    .pf-form-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.35rem;
        font-weight: 700;
        color: #1a1523;
        letter-spacing: -0.02em;
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid #f0edf8;
    }

    .pf-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .pf-field {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .pf-field.pf-full { grid-column: span 2; }

    .pf-label {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #6b6480;
    }

    .pf-input,
    .pf-select,
    .pf-textarea {
        width: 100%;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        color: #1a1523;
        background: #faf9fc;
        border: 1.5px solid #e5e0f0;
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        outline: none;
        -webkit-appearance: none;
    }

    .pf-input:focus,
    .pf-select:focus,
    .pf-textarea:focus {
        border-color: #7c5cbf;
        background: #fff;
        box-shadow: 0 0 0 3.5px rgba(124, 92, 191, 0.12);
    }

    .pf-input::placeholder,
    .pf-textarea::placeholder { color: #b0a8c4; }

    .pf-select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237c5cbf' stroke-width='1.8' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.9rem center;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    .pf-textarea {
        resize: vertical;
        min-height: 100px;
        line-height: 1.6;
    }

    /* Image upload zone */
    .pf-image-zone {
        border: 2px dashed #d9d2ee;
        border-radius: 12px;
        padding: 1.25rem;
        background: #faf9fc;
        transition: border-color 0.2s, background 0.2s;
        cursor: pointer;
    }

    .pf-image-zone:hover {
        border-color: #7c5cbf;
        background: #f4f0fc;
    }

    .pf-image-preview {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e5e0f0;
        margin-bottom: 0.75rem;
        display: block;
    }

    .pf-image-hint {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.82rem;
        color: #8b7faa;
    }

    .pf-image-hint svg { flex-shrink: 0; }

    .pf-file-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    /* Divider */
    .pf-divider {
        height: 1.5px;
        background: #f0edf8;
        margin: 0.5rem 0;
        grid-column: span 2;
    }

    /* Actions */
    .pf-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.75rem;
        padding-top: 1.5rem;
        border-top: 1.5px solid #f0edf8;
        margin-top: 0.5rem;
        grid-column: span 2;
    }

    .pf-btn-cancel {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b6480;
        background: transparent;
        border: 1.5px solid #e0daea;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: background 0.18s, border-color 0.18s, color 0.18s;
        cursor: pointer;
    }

    .pf-btn-cancel:hover {
        background: #f4f0fc;
        border-color: #c4b8e4;
        color: #1a1523;
    }

    .pf-btn-submit {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #7c5cbf 0%, #5e3fa3 100%);
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        cursor: pointer;
        transition: opacity 0.18s, box-shadow 0.18s, transform 0.15s;
        box-shadow: 0 2px 10px rgba(124, 92, 191, 0.28);
    }

    .pf-btn-submit:hover {
        opacity: 0.93;
        box-shadow: 0 4px 16px rgba(124, 92, 191, 0.38);
        transform: translateY(-1px);
    }

    .pf-btn-submit:active { transform: translateY(0); }

    @media (max-width: 520px) {
        .pf-grid { grid-template-columns: 1fr; }
        .pf-field.pf-full,
        .pf-divider,
        .pf-actions { grid-column: span 1; }
        .pf-form { padding: 1.5rem; }
    }
</style>

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="pf-form">

    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <p class="pf-form-title">
        {{ $product ? 'Edit Product' : 'New Product' }}
    </p>

    <div class="pf-grid">

        {{-- Name --}}
        <div class="pf-field pf-full">
            <label class="pf-label">Product name</label>
            <input type="text" name="name"
                   value="{{ old('name', $product->name ?? '') }}"
                   placeholder="e.g. Wireless Headphones"
                   class="pf-input">
        </div>

        {{-- Category --}}
        <div class="pf-field">
            <label class="pf-label">Category</label>
            <select name="category_id" class="pf-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Price --}}
        <div class="pf-field">
            <label class="pf-label">Price (MAD)</label>
            <input type="number" step="0.01" name="price"
                   value="{{ old('price', $product->price ?? '') }}"
                   placeholder="0.00"
                   class="pf-input">
        </div>

        {{-- Quantity --}}
        <div class="pf-field">
            <label class="pf-label">Quantity (stock)</label>
            <input type="number" name="quantity" min="0"
                   value="{{ old('quantity', $product->quantity ?? 0) }}"
                   placeholder="0"
                   class="pf-input">
        </div>

        {{-- Description --}}
        <div class="pf-field pf-full">
            <label class="pf-label">Description</label>
            <textarea name="description" class="pf-textarea"
                      placeholder="Describe your product…">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        {{-- Image --}}
        <div class="pf-field pf-full">
            <label class="pf-label">Product image</label>
            <div class="pf-image-zone" style="position:relative;">

                @if ($product && $product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="pf-image-preview" alt="Current image">
                @endif

                <div class="pf-image-hint">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="#7c5cbf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span>
                        <strong style="color:#5e3fa3;">Click to upload</strong>
                        &nbsp;or drag &amp; drop — PNG, JPG, WEBP
                    </span>
                </div>

                <input type="file" name="image" accept="image/*" class="pf-file-input">
            </div>
        </div>

        {{-- Actions --}}
        <div class="pf-actions">
            <a href="{{ route('seller.products.index') }}" class="pf-btn-cancel">
                Cancel
            </a>
            <button type="submit" class="pf-btn-submit">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                {{ $button }}
            </button>
        </div>

    </div>
</form>