@extends('layouts.admin')
@section('page-title', 'Hero Section')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Edit Hero Section</h2>
    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline btn-sm">🌐 Preview Website</a>
</div>

<form method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    {{-- ════════════════════════════════════════════════════════
         BADGE
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header"><span class="card-title">🏷️ Badge Text</span></div>
        <div class="form-grid">
            <div class="form-group">
                <label>Badge (English)</label>
                <input type="text" name="badge_text_en"
                       value="{{ old('badge_text_en', $hero->badge_text_en) }}" required>
            </div>
            <div class="form-group">
                <label>Badge (Arabic) — النص بالعربية</label>
                <input type="text" name="badge_text_ar"
                       value="{{ old('badge_text_ar', $hero->badge_text_ar) }}" dir="rtl" required>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         TITLE LINES
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">📝 Title Lines</span>
            <span style="font-size:.75rem;color:var(--muted);">3 lines displayed in hero section</span>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label>Line 1 (EN)</label>
                <input type="text" name="title_line1_en"
                       value="{{ old('title_line1_en', $hero->title_line1_en) }}" required>
            </div>
            <div class="form-group">
                <label>Line 1 (AR)</label>
                <input type="text" name="title_line1_ar"
                       value="{{ old('title_line1_ar', $hero->title_line1_ar) }}" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Line 2 (EN) — <span style="color:var(--gold);">Gold highlight</span></label>
                <input type="text" name="title_line2_en"
                       value="{{ old('title_line2_en', $hero->title_line2_en) }}" required>
            </div>
            <div class="form-group">
                <label>Line 2 (AR)</label>
                <input type="text" name="title_line2_ar"
                       value="{{ old('title_line2_ar', $hero->title_line2_ar) }}" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Line 3 (EN)</label>
                <input type="text" name="title_line3_en"
                       value="{{ old('title_line3_en', $hero->title_line3_en) }}" required>
            </div>
            <div class="form-group">
                <label>Line 3 (AR)</label>
                <input type="text" name="title_line3_ar"
                       value="{{ old('title_line3_ar', $hero->title_line3_ar) }}" dir="rtl" required>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         DESCRIPTION
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header"><span class="card-title">📄 Description</span></div>
        <div class="form-grid">
            <div class="form-group">
                <label>Description (English)</label>
                <textarea name="description_en" rows="4" required>{{ old('description_en', $hero->description_en) }}</textarea>
            </div>
            <div class="form-group">
                <label>Description (Arabic)</label>
                <textarea name="description_ar" dir="rtl" rows="4" required>{{ old('description_ar', $hero->description_ar) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         CTA BUTTONS
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header"><span class="card-title">🔘 CTA Buttons</span></div>
        <div class="form-grid cols3">
            <div class="form-group">
                <label>Primary Button (EN)</label>
                <input type="text" name="btn_primary_text_en"
                       value="{{ old('btn_primary_text_en', $hero->btn_primary_text_en) }}" required>
            </div>
            <div class="form-group">
                <label>Primary Button (AR)</label>
                <input type="text" name="btn_primary_text_ar"
                       value="{{ old('btn_primary_text_ar', $hero->btn_primary_text_ar) }}" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Primary Button URL</label>
                <input type="text" name="btn_primary_url"
                       value="{{ old('btn_primary_url', $hero->btn_primary_url) }}" required>
            </div>
            <div class="form-group">
                <label>Secondary Button (EN)</label>
                <input type="text" name="btn_secondary_text_en"
                       value="{{ old('btn_secondary_text_en', $hero->btn_secondary_text_en) }}" required>
            </div>
            <div class="form-group">
                <label>Secondary Button (AR)</label>
                <input type="text" name="btn_secondary_text_ar"
                       value="{{ old('btn_secondary_text_ar', $hero->btn_secondary_text_ar) }}" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Secondary Button URL</label>
                <input type="text" name="btn_secondary_url"
                       value="{{ old('btn_secondary_url', $hero->btn_secondary_url) }}" required>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         STATS
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header"><span class="card-title">📊 Statistics Counter</span></div>
        <div class="form-grid">
            <div class="form-group">
                <label>Projects Delivered</label>
                <input type="number" name="stat_projects"
                       value="{{ old('stat_projects', $hero->stat_projects) }}" min="0" required>
            </div>
            <div class="form-group">
                <label>Years Active</label>
                <input type="number" name="stat_years"
                       value="{{ old('stat_years', $hero->stat_years) }}" min="0" required>
            </div>
            <div class="form-group">
                <label>Engineers</label>
                <input type="number" name="stat_engineers"
                       value="{{ old('stat_engineers', $hero->stat_engineers) }}" min="0" required>
            </div>
            <div class="form-group">
                <label>Satisfaction %</label>
                <input type="number" name="stat_satisfaction"
                       value="{{ old('stat_satisfaction', $hero->stat_satisfaction) }}" min="0" max="100" required>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         SEO META
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">🔍 SEO Meta Tags</span>
            <span style="font-size:.75rem;color:var(--muted);">Shown in Google search results</span>
        </div>

        {{-- Character counters --}}
        <div style="background:rgba(245,168,0,.04);border:1px solid rgba(245,168,0,.1);border-radius:8px;padding:1rem;margin-bottom:1.5rem;font-size:.8rem;color:var(--muted);line-height:1.8;">
            💡 <strong style="color:var(--gold);">Best practices:</strong>
            Meta Title: 50–70 characters &nbsp;·&nbsp;
            Meta Description: 120–160 characters &nbsp;·&nbsp;
            Keywords: comma-separated, 5–10 phrases
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>
                    Meta Title (English)
                    <span id="mt_en_count" style="color:var(--gold);font-family:'Share Tech Mono',monospace;font-size:.72rem;margin-left:.5rem;">0/70</span>
                </label>
                <input type="text" name="meta_title_en" maxlength="70"
                       value="{{ old('meta_title_en', $hero->meta_title_en) }}"
                       oninput="countChars(this,'mt_en_count',70)"
                       placeholder="Alien Code — Next-Gen Software Development Company"
                       required>
                @error('meta_title_en')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>
                    عنوان الصفحة (Arabic)
                    <span id="mt_ar_count" style="color:var(--gold);font-family:'Share Tech Mono',monospace;font-size:.72rem;margin-left:.5rem;">0/70</span>
                </label>
                <input type="text" name="meta_title_ar" maxlength="70" dir="rtl"
                       value="{{ old('meta_title_ar', $hero->meta_title_ar) }}"
                       oninput="countChars(this,'mt_ar_count',70)"
                       placeholder="ألين كود — شركة تطوير برمجيات الجيل القادم"
                       required>
                @error('meta_title_ar')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>
                    Meta Description (English)
                    <span id="md_en_count" style="color:var(--gold);font-family:'Share Tech Mono',monospace;font-size:.72rem;margin-left:.5rem;">0/160</span>
                </label>
                <textarea name="meta_description_en" rows="3" maxlength="160"
                          oninput="countChars(this,'md_en_count',160)"
                          placeholder="Alien Code builds high-performance web apps, mobile apps, AI systems and cloud infrastructure for startups and enterprises worldwide."
                          required>{{ old('meta_description_en', $hero->meta_description_en) }}</textarea>
                @error('meta_description_en')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>
                    وصف الصفحة (Arabic)
                    <span id="md_ar_count" style="color:var(--gold);font-family:'Share Tech Mono',monospace;font-size:.72rem;margin-left:.5rem;">0/160</span>
                </label>
                <textarea name="meta_description_ar" rows="3" dir="rtl" maxlength="160"
                          oninput="countChars(this,'md_ar_count',160)"
                          placeholder="ألين كود تبني تطبيقات ويب وجوال وأنظمة ذكاء اصطناعي وبنية سحابية للشركات حول العالم."
                          required>{{ old('meta_description_ar', $hero->meta_description_ar) }}</textarea>
                @error('meta_description_ar')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Keywords (English)</label>
                <input type="text" name="meta_keywords_en"
                       value="{{ old('meta_keywords_en', $hero->meta_keywords_en) }}"
                       placeholder="software development, web apps, AI, Jordan, Amman">
                <div class="hint">Comma-separated — 5 to 10 keyphrases</div>
            </div>
            <div class="form-group">
                <label>الكلمات المفتاحية (Arabic)</label>
                <input type="text" name="meta_keywords_ar" dir="rtl"
                       value="{{ old('meta_keywords_ar', $hero->meta_keywords_ar) }}"
                       placeholder="تطوير برمجيات, تطبيقات ويب, ذكاء اصطناعي, الأردن, عمان">
                <div class="hint">مفصولة بفواصل — من 5 إلى 10 عبارات</div>
            </div>
        </div>

        {{-- SERP Preview --}}
        <div style="margin-top:1.5rem;">
            <div style="font-family:'Orbitron',sans-serif;font-size:.7rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.8rem;">
                Google SERP Preview
            </div>
            <div style="background:#fff;border-radius:8px;padding:1.2rem 1.5rem;max-width:600px;">
                <div id="serpUrl" style="font-family:Arial,sans-serif;font-size:.8rem;color:#006621;margin-bottom:.2rem;">alien-code.io</div>
                <div id="serpTitle" style="font-family:Arial,sans-serif;font-size:1.1rem;color:#1a0dab;margin-bottom:.3rem;font-weight:400;line-height:1.3;">
                    {{ $hero->meta_title_en ?? 'Alien Code — Next-Gen Software Development' }}
                </div>
                <div id="serpDesc" style="font-family:Arial,sans-serif;font-size:.85rem;color:#545454;line-height:1.5;">
                    {{ $hero->meta_description_en ?? 'Alien Code builds high-performance applications...' }}
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         OPEN GRAPH
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">📱 Open Graph — Social Share</span>
            <span style="font-size:.75rem;color:var(--muted);">Facebook, LinkedIn, WhatsApp previews</span>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>OG Title (English)</label>
                <input type="text" name="og_title_en"
                       value="{{ old('og_title_en', $hero->og_title_en) }}"
                       placeholder="Leave empty to use Meta Title">
            </div>
            <div class="form-group">
                <label>عنوان المشاركة (Arabic)</label>
                <input type="text" name="og_title_ar" dir="rtl"
                       value="{{ old('og_title_ar', $hero->og_title_ar) }}"
                       placeholder="اتركه فارغاً لاستخدام عنوان الـ Meta">
            </div>
            <div class="form-group">
                <label>OG Description (English)</label>
                <textarea name="og_description_en" rows="3" maxlength="200"
                          placeholder="Leave empty to use Meta Description">{{ old('og_description_en', $hero->og_description_en) }}</textarea>
            </div>
            <div class="form-group">
                <label>وصف المشاركة (Arabic)</label>
                <textarea name="og_description_ar" dir="rtl" rows="3" maxlength="200"
                          placeholder="اتركه فارغاً لاستخدام وصف الـ Meta">{{ old('og_description_ar', $hero->og_description_ar) }}</textarea>
            </div>
        </div>

        {{-- OG Image --}}
        <div class="form-group" style="margin-top:.5rem;">
            <label>OG Share Image <span style="color:var(--muted);font-weight:400;">(Recommended: 1200 × 630 px)</span></label>
            @if($hero->og_image)
                <div style="margin-bottom:.8rem;">
                    <img src="{{ asset('assets/admin/uploads/'.$hero->og_image) }}"
                         style="max-height:120px;border-radius:8px;border:1px solid rgba(245,168,0,.2);object-fit:cover;">
                    <div style="font-size:.75rem;color:var(--muted);margin-top:.3rem;">Current image</div>
                </div>
            @endif
            <div class="file-upload-btn">
                <button type="button" class="btn btn-outline btn-sm">📁 Upload OG Image</button>
                <input type="file" name="og_image" accept="image/jpeg,image/png,image/webp"
                       onchange="previewOg(this)">
            </div>
            <div class="hint">Max 2MB — JPG or PNG, exactly 1200×630px for best results</div>
            <img id="ogPreview" src="" style="display:none;margin-top:.8rem;max-height:100px;border-radius:6px;border:1px solid rgba(245,168,0,.2);">
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         TWITTER CARD
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">𝕏 Twitter / X Card</span>
            <span style="font-size:.75rem;color:var(--muted);">Twitter preview when shared</span>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Card Type</label>
                <select name="twitter_card">
                    <option value="summary_large_image" {{ old('twitter_card', $hero->twitter_card) === 'summary_large_image' ? 'selected' : '' }}>
                        summary_large_image (recommended)
                    </option>
                    <option value="summary" {{ old('twitter_card', $hero->twitter_card) === 'summary' ? 'selected' : '' }}>
                        summary (small image)
                    </option>
                </select>
            </div>
            <div class="form-group">
                {{-- spacer --}}
            </div>
            <div class="form-group">
                <label>Twitter Title (English)</label>
                <input type="text" name="twitter_title_en"
                       value="{{ old('twitter_title_en', $hero->twitter_title_en) }}"
                       placeholder="Leave empty to use OG Title">
            </div>
            <div class="form-group">
                <label>عنوان تويتر (Arabic)</label>
                <input type="text" name="twitter_title_ar" dir="rtl"
                       value="{{ old('twitter_title_ar', $hero->twitter_title_ar) }}"
                       placeholder="اتركه فارغاً لاستخدام عنوان OG">
            </div>
            <div class="form-group">
                <label>Twitter Description (English)</label>
                <textarea name="twitter_description_en" rows="2" maxlength="200"
                          placeholder="Leave empty to use OG Description">{{ old('twitter_description_en', $hero->twitter_description_en) }}</textarea>
            </div>
            <div class="form-group">
                <label>وصف تويتر (Arabic)</label>
                <textarea name="twitter_description_ar" dir="rtl" rows="2" maxlength="200"
                          placeholder="اتركه فارغاً لاستخدام وصف OG">{{ old('twitter_description_ar', $hero->twitter_description_ar) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         SCHEMA.ORG
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">🗂️ Schema.org Structured Data</span>
            <span style="font-size:.75rem;color:var(--muted);">Enables Google rich results</span>
        </div>

        <div class="form-grid cols3">
            <div class="form-group">
                <label>Organization Name</label>
                <input type="text" name="schema_org_name"
                       value="{{ old('schema_org_name', $hero->schema_org_name ?? 'Alien Code') }}"
                       placeholder="Alien Code">
            </div>
            <div class="form-group">
                <label>Organization Type</label>
                <select name="schema_org_type">
                    @foreach([
                        'SoftwareCompany'    => 'SoftwareCompany',
                        'Organization'       => 'Organization',
                        'Corporation'        => 'Corporation',
                        'LocalBusiness'      => 'LocalBusiness',
                        'ProfessionalService'=> 'ProfessionalService',
                    ] as $val => $label)
                    <option value="{{ $val }}" {{ old('schema_org_type', $hero->schema_org_type ?? 'SoftwareCompany') === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Founding Year</label>
                <input type="number" name="schema_org_founding_year" min="1900" max="{{ date('Y') }}"
                       value="{{ old('schema_org_founding_year', $hero->schema_org_founding_year ?? '2016') }}"
                       placeholder="2016">
            </div>
            <div class="form-group">
                <label>Website URL</label>
                <input type="url" name="schema_org_url"
                       value="{{ old('schema_org_url', $hero->schema_org_url) }}"
                       placeholder="https://alien-code.io">
            </div>
            <div class="form-group">
                <label>Number of Employees</label>
                <input type="number" name="schema_org_number_of_employees" min="1"
                       value="{{ old('schema_org_number_of_employees', $hero->schema_org_number_of_employees ?? 50) }}"
                       placeholder="50">
            </div>
            <div class="form-group">
                {{-- spacer --}}
            </div>
            <div class="form-group">
                <label>Organization Description (English)</label>
                <textarea name="schema_org_description_en" rows="2"
                          placeholder="Same as meta description or more detailed">{{ old('schema_org_description_en', $hero->schema_org_description_en) }}</textarea>
            </div>
            <div class="form-group">
                <label>وصف المنظمة (Arabic)</label>
                <textarea name="schema_org_description_ar" dir="rtl" rows="2"
                          placeholder="نفس وصف الـ Meta أو أكثر تفصيلاً">{{ old('schema_org_description_ar', $hero->schema_org_description_ar) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         CANONICAL & ROBOTS
         ════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">🔗 Canonical URLs & Robots</span>
            <span style="font-size:.75rem;color:var(--muted);">Prevent duplicate content, control indexing</span>
        </div>

        <div class="form-grid cols3">
            <div class="form-group">
                <label>Canonical URL (English)</label>
                <input type="url" name="canonical_url_en"
                       value="{{ old('canonical_url_en', $hero->canonical_url_en) }}"
                       placeholder="https://alien-code.io/en">
            </div>
            <div class="form-group">
                <label>Canonical URL (Arabic)</label>
                <input type="url" name="canonical_url_ar"
                       value="{{ old('canonical_url_ar', $hero->canonical_url_ar) }}"
                       placeholder="https://alien-code.io/ar">
            </div>
            <div class="form-group">
                <label>Robots Meta Tag</label>
                <select name="robots">
                    @foreach([
                        'index, follow'        => 'index, follow (recommended)',
                        'noindex, follow'      => 'noindex, follow',
                        'index, nofollow'      => 'index, nofollow',
                        'noindex, nofollow'    => 'noindex, nofollow (block all)',
                    ] as $val => $label)
                    <option value="{{ $val }}" {{ old('robots', $hero->robots ?? 'index, follow') === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                <div class="hint">Keep "index, follow" unless you have a specific reason to change it</div>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         SAVE BUTTON
         ════════════════════════════════════════════════════════ --}}
    <div style="display:flex;gap:1rem;align-items:center;margin-bottom:3rem;">
        <button type="submit" class="btn btn-gold">💾 Save Hero Section</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Cancel</a>
        <span style="font-size:.78rem;color:var(--muted);margin-left:auto;">
            Last updated: {{ $hero->updated_at ? $hero->updated_at->diffForHumans() : 'Never' }}
        </span>
    </div>

</form>
@endsection

@push('scripts')
<script>
// ── Character counter ─────────────────────────────────────
function countChars(el, counterId, max) {
    const len = el.value.length;
    const counter = document.getElementById(counterId);
    if (!counter) return;
    counter.textContent = len + '/' + max;
    counter.style.color = len > max * 0.9
        ? (len >= max ? '#ef4444' : '#f59e0b')
        : 'var(--gold)';
}

// ── Init counters on load ─────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    [
        ['meta_title_en',       'mt_en_count', 70],
        ['meta_title_ar',       'mt_ar_count', 70],
        ['meta_description_en', 'md_en_count', 160],
        ['meta_description_ar', 'md_ar_count', 160],
    ].forEach(([name, id, max]) => {
        const el = document.querySelector('[name="' + name + '"]');
        if (el) countChars(el, id, max);
    });

    // ── Live SERP preview ─────────────────────────────────
    const titleInput = document.querySelector('[name="meta_title_en"]');
    const descInput  = document.querySelector('[name="meta_description_en"]');
    const serpTitle  = document.getElementById('serpTitle');
    const serpDesc   = document.getElementById('serpDesc');

    if (titleInput && serpTitle) {
        titleInput.addEventListener('input', () => {
            serpTitle.textContent = titleInput.value || 'Your page title';
        });
    }
    if (descInput && serpDesc) {
        descInput.addEventListener('input', () => {
            const txt = descInput.value || 'Your meta description will appear here...';
            serpDesc.textContent = txt.length > 155 ? txt.slice(0, 155) + '…' : txt;
        });
    }
});

// ── OG image preview ─────────────────────────────────────
function previewOg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const prev = document.getElementById('ogPreview');
            prev.src = e.target.result;
            prev.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush