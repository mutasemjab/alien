<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class SeoGuidesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = $this->pages();

        foreach ($pages as $page) {
            if (Blog::where('slug', $page['slug'])->orWhere('title_en', $page['title_en'])->exists()) {
                $this->command->line("  skip  {$page['slug']}");
                continue;
            }

            Blog::create(array_merge($page, [
                'type'         => 'landing_page',
                'is_active'    => true,
                'published_at' => now(),
                'author'       => 'Alien Code',
            ]));

            $this->command->info("  seeded {$page['slug']}");
        }
    }

    private function pages(): array
    {
        return [

            // ── 1. Website cost Jordan ─────────────────────────────────────
            [
                'slug'         => 'website-cost-jordan',
                'title_en'     => 'How Much Does a Website Cost in Jordan? (2025 Guide)',
                'title_ar'     => 'كم تكلفة تصميم موقع إلكتروني في الأردن؟ (دليل 2025)',
                'excerpt_en'   => 'A transparent breakdown of website development costs in Jordan for 2025 — from simple landing pages (250 JD) to enterprise platforms (15,000 JD+), with real market data.',
                'excerpt_ar'   => 'تفصيل شفاف لتكاليف تطوير المواقع الإلكترونية في الأردن لعام 2025 — من الصفحات البسيطة (250 د.أ) إلى المنصات المؤسسية (+15,000 د.أ).',
                'meta_title_en'=> 'Website Cost in Jordan 2025 — Pricing Guide | Alien Code',
                'meta_title_ar'=> 'تكلفة تصميم موقع إلكتروني في الأردن 2025 | Alien Code',
                'meta_desc_en' => 'How much does a website cost in Jordan in 2025? Full price breakdown by type: landing page, business site, e-commerce, custom web app. Real market rates.',
                'meta_desc_ar' => 'كم تكلفة تصميم موقع في الأردن 2025؟ تفصيل كامل للأسعار حسب النوع: صفحة هبوط، موقع أعمال، متجر إلكتروني، تطبيق ويب مخصص.',
                'category_en'  => 'Guides',
                'category_ar'  => 'أدلة',
                'tags'         => ['Website Cost', 'Jordan', 'Pricing', 'Web Development'],
                'body_en'      => '<h2>Website Cost in Jordan — 2025 Market Rates</h2>
<p>The most common question we hear from Jordanian business owners is: "How much does a website cost?" The honest answer is: it depends on what you need. This guide gives you real numbers from the Jordanian market so you can budget confidently.</p>

<h2>Website Types and Price Ranges</h2>
<table style="width:100%;border-collapse:collapse;">
<thead><tr style="border-bottom:1px solid rgba(255,255,255,.2);">
<th style="text-align:left;padding:.5rem;">Type</th>
<th style="text-align:left;padding:.5rem;">Price Range (JOD)</th>
<th style="text-align:left;padding:.5rem;">Timeline</th>
</tr></thead>
<tbody>
<tr><td style="padding:.5rem;">Landing Page (1–3 pages)</td><td style="padding:.5rem;">250 – 800 JD</td><td style="padding:.5rem;">1–2 weeks</td></tr>
<tr><td style="padding:.5rem;">Business / Corporate Site (5–15 pages)</td><td style="padding:.5rem;">800 – 2,500 JD</td><td style="padding:.5rem;">3–6 weeks</td></tr>
<tr><td style="padding:.5rem;">WordPress with CMS</td><td style="padding:.5rem;">600 – 2,000 JD</td><td style="padding:.5rem;">2–5 weeks</td></tr>
<tr><td style="padding:.5rem;">E-commerce Store (up to 500 products)</td><td style="padding:.5rem;">2,500 – 6,000 JD</td><td style="padding:.5rem;">6–12 weeks</td></tr>
<tr><td style="padding:.5rem;">Custom Web Application</td><td style="padding:.5rem;">5,000 – 20,000 JD</td><td style="padding:.5rem;">3–6 months</td></tr>
<tr><td style="padding:.5rem;">Enterprise Platform / SaaS</td><td style="padding:.5rem;">15,000 JD+</td><td style="padding:.5rem;">6–18 months</td></tr>
</tbody>
</table>

<h2>What Drives the Price Up?</h2>
<ul>
<li><strong>Custom design</strong> — a unique UI built from scratch costs more than a template</li>
<li><strong>Arabic RTL + bilingual</strong> — adds 15–25% to frontend development time</li>
<li><strong>Integrations</strong> — payment gateways, CRM, ERP, shipping APIs</li>
<li><strong>Content management</strong> — the more your team needs to edit, the more CMS setup is needed</li>
<li><strong>Ongoing maintenance</strong> — hosting, SSL, updates, backups (typically 50–200 JD/month)</li>
</ul>

<h2>What Drives the Price Down?</h2>
<ul>
<li>Using a starter template instead of full custom design</li>
<li>Providing your own content (text, images, copywriting)</li>
<li>Starting with a minimal feature set and expanding later (MVP approach)</li>
<li>Choosing a local Jordan agency over an overseas freelancer (removes timezone and communication overhead)</li>
</ul>

<h2>Freelancer vs. Agency vs. Overseas</h2>
<p>A Jordan freelancer typically charges 15–35 JD/hour. A Jordanian agency like Alien Code charges 35–65 JD/hour but provides project management, QA, design, and post-launch support. Overseas agencies (UK, US) charge 80–200 USD/hour for the same quality of work. For most Jordanian SMEs, a local agency offers the best value.</p>

<h2>Hidden Costs to Budget For</h2>
<ul>
<li>Domain registration: 15–40 JD/year</li>
<li>Hosting: 50–300 JD/year depending on traffic</li>
<li>SSL certificate: usually included in modern hosting</li>
<li>Stock photos / video: 0–500 JD depending on source</li>
<li>SEO setup (once): 200–800 JD</li>
<li>Monthly SEO / content: 150–600 JD/month</li>
</ul>

<h2>Get an Instant Estimate</h2>
<p>Use our <a href="/en/tools/project-cost-estimator">free project cost estimator</a> to get a rough range for your specific project in under 2 minutes. For a detailed proposal, <a href="/en/contact">contact Alien Code</a> and we will respond within 24 hours.</p>',
                'body_ar'      => '<h2>تكلفة تصميم موقع إلكتروني في الأردن — أسعار السوق 2025</h2>
<p>السؤال الأكثر شيوعاً الذي نسمعه من أصحاب الأعمال الأردنيين: "كم تكلفة الموقع الإلكتروني؟" الجواب الصادق: يعتمد على ما تحتاجه. هذا الدليل يعطيك أرقاماً حقيقية من السوق الأردني حتى تتمكن من وضع ميزانية بثقة.</p>

<h2>أنواع المواقع ونطاقات الأسعار</h2>
<table style="width:100%;border-collapse:collapse;">
<thead><tr style="border-bottom:1px solid rgba(255,255,255,.2);">
<th style="text-align:right;padding:.5rem;">النوع</th>
<th style="text-align:right;padding:.5rem;">نطاق السعر (د.أ)</th>
<th style="text-align:right;padding:.5rem;">المدة</th>
</tr></thead>
<tbody>
<tr><td style="padding:.5rem;text-align:right;">صفحة هبوط (1–3 صفحات)</td><td style="padding:.5rem;text-align:right;">250 – 800 د.أ</td><td style="padding:.5rem;text-align:right;">1–2 أسبوع</td></tr>
<tr><td style="padding:.5rem;text-align:right;">موقع أعمال / شركات (5–15 صفحة)</td><td style="padding:.5rem;text-align:right;">800 – 2,500 د.أ</td><td style="padding:.5sm;text-align:right;">3–6 أسابيع</td></tr>
<tr><td style="padding:.5rem;text-align:right;">WordPress مع نظام إدارة محتوى</td><td style="padding:.5rem;text-align:right;">600 – 2,000 د.أ</td><td style="padding:.5rem;text-align:right;">2–5 أسابيع</td></tr>
<tr><td style="padding:.5rem;text-align:right;">متجر إلكتروني (حتى 500 منتج)</td><td style="padding:.5rem;text-align:right;">2,500 – 6,000 د.أ</td><td style="padding:.5rem;text-align:right;">6–12 أسبوعاً</td></tr>
<tr><td style="padding:.5rem;text-align:right;">تطبيق ويب مخصص</td><td style="padding:.5rem;text-align:right;">5,000 – 20,000 د.أ</td><td style="padding:.5rem;text-align:right;">3–6 أشهر</td></tr>
</tbody>
</table>

<h2>ما الذي يرفع السعر؟</h2>
<ul>
<li><strong>التصميم المخصص</strong> — واجهة مستخدم فريدة من الصفر تكلف أكثر من قالب جاهز</li>
<li><strong>ثنائية اللغة عربي + إنجليزي</strong> — يضيف 15–25% على وقت تطوير الواجهة الأمامية</li>
<li><strong>التكاملات</strong> — بوابات دفع، CRM، ERP، APIs الشحن</li>
<li><strong>الصيانة الدورية</strong> — استضافة، SSL، تحديثات، نسخ احتياطية (عادة 50–200 د.أ/شهر)</li>
</ul>

<h2>احصل على تقدير فوري</h2>
<p>استخدم <a href="/ar/tools/project-cost-estimator">أداة تقدير تكلفة المشروع المجانية</a> للحصول على نطاق تقريبي لمشروعك في أقل من دقيقتين.</p>',
            ],

            // ── 2. Mobile app cost Jordan ──────────────────────────────────
            [
                'slug'         => 'mobile-app-development-cost-jordan',
                'title_en'     => 'Mobile App Development Cost in Jordan 2025 — Full Guide',
                'title_ar'     => 'تكلفة تطوير تطبيق جوال في الأردن 2025 — دليل شامل',
                'excerpt_en'   => 'Everything you need to know about mobile app development costs in Jordan: iOS, Android, Flutter cross-platform, MVP vs full build, hidden fees, and how to save budget.',
                'excerpt_ar'   => 'كل ما تحتاجه عن تكاليف تطوير تطبيقات الجوال في الأردن: iOS، Android، Flutter، MVP مقابل البناء الكامل، والرسوم الخفية.',
                'meta_title_en'=> 'Mobile App Cost Jordan 2025 — iOS Android Flutter | Alien Code',
                'meta_title_ar'=> 'تكلفة تطبيق جوال في الأردن 2025 | Alien Code',
                'meta_desc_en' => 'How much does a mobile app cost in Jordan in 2025? Price breakdown for iOS, Android, and Flutter apps by complexity — from simple apps (2,000 JD) to enterprise (50,000 JD+).',
                'meta_desc_ar' => 'كم تكلفة تطبيق جوال في الأردن 2025؟ تفصيل أسعار iOS وAndroid وFlutter حسب التعقيد — من التطبيقات البسيطة (2,000 د.أ) إلى المؤسسية (+50,000 د.أ).',
                'category_en'  => 'Guides',
                'category_ar'  => 'أدلة',
                'tags'         => ['Mobile App Cost', 'Jordan', 'iOS', 'Android', 'Flutter'],
                'body_en'      => '<h2>Mobile App Development Costs in Jordan (2025)</h2>
<p>Building a mobile app in Jordan is more affordable than in the US or Europe — but the range is still enormous. A simple utility app might cost 2,000 JD; a full-featured marketplace with real-time tracking might cost 40,000 JD. Here is how to think about it.</p>

<h2>Price Ranges by App Complexity</h2>
<table style="width:100%;border-collapse:collapse;">
<thead><tr style="border-bottom:1px solid rgba(255,255,255,.2);">
<th style="text-align:left;padding:.5rem;">Complexity</th>
<th style="text-align:left;padding:.5rem;">Features</th>
<th style="text-align:left;padding:.5rem;">Cost (JOD)</th>
<th style="text-align:left;padding:.5rem;">Timeline</th>
</tr></thead>
<tbody>
<tr><td style="padding:.5rem;">Simple</td><td style="padding:.5rem;">Auth, static content, 3–5 screens</td><td style="padding:.5rem;">2,000 – 5,000</td><td style="padding:.5rem;">4–8 weeks</td></tr>
<tr><td style="padding:.5rem;">Medium</td><td style="padding:.5rem;">API backend, payments, push notifications</td><td style="padding:.5rem;">5,000 – 15,000</td><td style="padding:.5rem;">8–16 weeks</td></tr>
<tr><td style="padding:.5rem;">Complex</td><td style="padding:.5rem;">Real-time, maps, multi-role, admin panel</td><td style="padding:.5rem;">15,000 – 35,000</td><td style="padding:.5rem;">4–8 months</td></tr>
<tr><td style="padding:.5rem;">Enterprise</td><td style="padding:.5rem;">ERP integration, AI, high-scale backend</td><td style="padding:.5rem;">35,000+</td><td style="padding:.5rem;">8+ months</td></tr>
</tbody>
</table>

<h2>Native vs Cross-Platform (Flutter)</h2>
<p>Building separate iOS and Android apps (native) roughly doubles the cost. With Flutter, you get one codebase that runs on both platforms — saving 35–50% on development cost. The performance and UI quality are now virtually indistinguishable from native for 95% of apps. We recommend Flutter for most Jordanian businesses.</p>

<h2>What Adds Cost</h2>
<ul>
<li>Payment gateway integration (Stripe, eFAWATEERcom, MyFatoorah): 500–1,500 JD</li>
<li>Maps &amp; GPS tracking: 1,000–3,000 JD</li>
<li>Push notifications: 300–600 JD</li>
<li>Admin dashboard: 1,500–4,000 JD</li>
<li>Arabic RTL support + bilingual: 500–1,000 JD</li>
<li>App Store submission &amp; setup: 200–400 JD</li>
</ul>

<h2>MVP Strategy — Ship Faster, Spend Less</h2>
<p>We recommend building an MVP (Minimum Viable Product) first — 5–8 core screens, one user role, basic backend. Launch in 6–10 weeks for 3,000–8,000 JD. Then use real user feedback to prioritise which features to build next. This approach reduces wasted development and often reveals the app only needs 60% of originally planned features.</p>',
                'body_ar'      => '<h2>تكاليف تطوير تطبيق جوال في الأردن (2025)</h2>
<p>بناء تطبيق جوال في الأردن أكثر تكلفةً بأسعار معقولة مقارنة بأمريكا أو أوروبا — لكن النطاق لا يزال واسعاً. تطبيق مساعد بسيط قد يكلف 2,000 د.أ؛ سوق إلكتروني متكامل مع تتبع الوقت الحقيقي قد يكلف 40,000 د.أ.</p>

<h2>نطاقات الأسعار حسب تعقيد التطبيق</h2>
<table style="width:100%;border-collapse:collapse;">
<thead><tr style="border-bottom:1px solid rgba(255,255,255,.2);">
<th style="text-align:right;padding:.5rem;">التعقيد</th>
<th style="text-align:right;padding:.5rem;">التكلفة (د.أ)</th>
<th style="text-align:right;padding:.5rem;">المدة</th>
</tr></thead>
<tbody>
<tr><td style="padding:.5rem;text-align:right;">بسيط (3–5 شاشات)</td><td style="padding:.5rem;text-align:right;">2,000 – 5,000</td><td style="padding:.5rem;text-align:right;">4–8 أسابيع</td></tr>
<tr><td style="padding:.5rem;text-align:right;">متوسط (مدفوعات، إشعارات)</td><td style="padding:.5rem;text-align:right;">5,000 – 15,000</td><td style="padding:.5rem;text-align:right;">8–16 أسبوعاً</td></tr>
<tr><td style="padding:.5rem;text-align:right;">معقد (خرائط، أدوار متعددة)</td><td style="padding:.5rem;text-align:right;">15,000 – 35,000</td><td style="padding:.5rem;text-align:right;">4–8 أشهر</td></tr>
<tr><td style="padding:.5rem;text-align:right;">مؤسسي (ERP، ذكاء اصطناعي)</td><td style="padding:.5rem;text-align:right;">+35,000</td><td style="padding:.5rem;text-align:right;">+8 أشهر</td></tr>
</tbody>
</table>

<h2>أصلي مقابل متقاطع المنصات (Flutter)</h2>
<p>بناء تطبيقات iOS وAndroid منفصلة يضاعف التكلفة تقريباً. مع Flutter، تحصل على قاعدة كود واحدة تعمل على كلتا المنصتين — مما يوفر 35–50% من تكلفة التطوير. نوصي بـFlutter لمعظم الأعمال الأردنية.</p>',
            ],

            // ── 3. Custom vs ready-made ────────────────────────────────────
            [
                'slug'         => 'custom-software-vs-ready-made-jordan',
                'title_en'     => 'Custom Software vs Ready-Made Software in Jordan — Which Is Right for You?',
                'title_ar'     => 'البرمجيات المخصصة مقابل الجاهزة في الأردن — أيهما يناسبك؟',
                'excerpt_en'   => 'An honest comparison of custom-built software vs off-the-shelf solutions for Jordanian businesses — costs, pros, cons, and when each makes sense.',
                'excerpt_ar'   => 'مقارنة صادقة بين البرمجيات المخصصة والحلول الجاهزة للأعمال الأردنية — التكاليف والمزايا والعيوب ومتى يكون كل منهما منطقياً.',
                'meta_title_en'=> 'Custom vs Ready-Made Software Jordan — Full Comparison | Alien Code',
                'meta_title_ar'=> 'برمجيات مخصصة مقابل جاهزة في الأردن | Alien Code',
                'meta_desc_en' => 'Should your Jordan business buy off-the-shelf software or build custom? Compare cost, flexibility, scalability, and integration needs with this honest 2025 guide.',
                'meta_desc_ar' => 'هل يجب أن تشتري برنامجاً جاهزاً أم تبني برنامجاً مخصصاً لعملك في الأردن؟ قارن التكلفة والمرونة والتوسعية بهذا الدليل الصادق لعام 2025.',
                'category_en'  => 'Guides',
                'category_ar'  => 'أدلة',
                'tags'         => ['Custom Software', 'Ready-made', 'Jordan', 'ERP', 'Decision Guide'],
                'body_en'      => '<h2>Custom vs Ready-Made Software: The Key Question</h2>
<p>One of the most important technology decisions a Jordanian business owner faces is: should we buy an off-the-shelf solution or build something custom? There is no universal answer — the right choice depends on your business size, budget, uniqueness of your processes, and growth plans.</p>

<h2>Ready-Made Software — Pros &amp; Cons</h2>
<h3>Examples in Jordan</h3>
<p>QuickBooks or Zoho Books (accounting), Odoo Community (ERP lite), Shopify (e-commerce), Bitrix24 (CRM), WooCommerce (online store).</p>
<ul>
<li>✅ Low upfront cost — often 0–200 JD/month subscription</li>
<li>✅ Ready immediately, no development time</li>
<li>✅ Regular updates and security patches included</li>
<li>✅ Large community support and documentation</li>
<li>❌ Monthly fees accumulate: 200 JD/month = 2,400 JD/year = 12,000 JD over 5 years</li>
<li>❌ You adapt your process to fit the software, not the other way around</li>
<li>❌ Limited ability to integrate with Jordanian-specific systems (e-Invoice, Zain SMS, eFAWATEERcom)</li>
<li>❌ Data stored on foreign servers (PDPL compliance considerations)</li>
<li>❌ Vendor lock-in — price hikes, discontinued products, or feature removal</li>
</ul>

<h2>Custom Software — Pros &amp; Cons</h2>
<ul>
<li>✅ Built exactly for your workflow — zero unnecessary features</li>
<li>✅ Owns the code and data permanently — no ongoing subscription</li>
<li>✅ Integrates with any Jordanian system: e-Invoice, CBJ, JODDB, SSC portal</li>
<li>✅ Scales as you grow — add features without re-platforming</li>
<li>✅ Competitive advantage — your competitors cannot buy the same tool</li>
<li>❌ Higher upfront investment: 3,000–50,000 JD depending on scope</li>
<li>❌ Development time: 4 weeks to 6 months</li>
<li>❌ Requires maintenance and updates (typically 100–500 JD/month)</li>
</ul>

<h2>The Break-Even Calculation</h2>
<p>If a ready-made solution costs 250 JD/month and a custom equivalent costs 8,000 JD to build + 150 JD/month maintenance, the break-even is: (8,000) / (250 − 150) = 80 months ≈ 6.7 years. But if the ready-made is 500 JD/month: (8,000) / (500 − 150) = 23 months ≈ 2 years.</p>

<h2>When to Choose Ready-Made</h2>
<p>Use ready-made software when your process is standard, you are just starting out, the subscription cost is under 100 JD/month, and you need to launch within days.</p>

<h2>When to Choose Custom</h2>
<p>Choose custom when your process is unique, you are spending 300+ JD/month on subscriptions for multiple tools, you need Jordan-specific integrations, or you have a competitive feature that should not be available to rivals.</p>',
                'body_ar'      => '<h2>برمجيات مخصصة مقابل جاهزة: السؤال الرئيسي</h2>
<p>أحد أهم قرارات التقنية التي يواجهها صاحب عمل أردني: هل نشتري حلاً جاهزاً أم نبني شيئاً مخصصاً؟ لا توجد إجابة عالمية — الاختيار الصحيح يعتمد على حجم عملك وميزانيتك وفرادة عمليات العمل وخطط النمو.</p>

<h2>البرمجيات الجاهزة — المزايا والعيوب</h2>
<ul>
<li>✅ تكلفة مقدمة منخفضة — غالباً 0–200 د.أ/شهر اشتراك</li>
<li>✅ جاهزة فوراً، لا وقت تطوير</li>
<li>✅ تحديثات وتصحيحات أمنية منتظمة مشمولة</li>
<li>❌ الرسوم الشهرية تتراكم: 200 د.أ/شهر = 12,000 د.أ على 5 سنوات</li>
<li>❌ تتكيف عملياتك مع البرنامج وليس العكس</li>
<li>❌ تكامل محدود مع الأنظمة الأردنية (الفاتورة الإلكترونية، Zain SMS، eFAWATEERcom)</li>
<li>❌ البيانات على خوادم خارجية (اعتبارات امتثال PDPL)</li>
</ul>

<h2>البرمجيات المخصصة — المزايا والعيوب</h2>
<ul>
<li>✅ مبنية تماماً لسير عملك — صفر ميزات غير ضرورية</li>
<li>✅ تملك الكود والبيانات بشكل دائم — لا اشتراك مستمر</li>
<li>✅ تتكامل مع أي نظام أردني</li>
<li>✅ ميزة تنافسية — منافسوك لا يستطيعون شراء نفس الأداة</li>
<li>❌ استثمار مقدم أعلى: 3,000–50,000 د.أ حسب النطاق</li>
<li>❌ وقت التطوير: 4 أسابيع إلى 6 أشهر</li>
</ul>',
            ],

            // ── 4. How to choose a software company ───────────────────────
            [
                'slug'         => 'how-to-choose-software-company-jordan',
                'title_en'     => 'How to Choose a Software Development Company in Jordan (2025 Guide)',
                'title_ar'     => 'كيف تختار شركة برمجيات في الأردن؟ (دليل 2025)',
                'excerpt_en'   => 'A practical guide to evaluating and selecting the right software development partner in Jordan — portfolio, team, process, contracts, and red flags.',
                'excerpt_ar'   => 'دليل عملي لتقييم واختيار شريك البرمجيات المناسب في الأردن — المحفظة والفريق والعملية والعقود والعلامات التحذيرية.',
                'meta_title_en'=> 'How to Choose a Software Company in Jordan — 2025 Guide',
                'meta_title_ar'=> 'كيف تختار شركة برمجة في الأردن 2025',
                'meta_desc_en' => 'How to find and evaluate the best software development company in Jordan. Checklist of 12 questions to ask, red flags to avoid, and what a fair contract looks like.',
                'meta_desc_ar' => 'كيف تجد وتقيّم أفضل شركة برمجيات في الأردن. قائمة مراجعة من 12 سؤالاً يجب طرحها والعلامات التحذيرية وما يبدو عليه العقد العادل.',
                'category_en'  => 'Guides',
                'category_ar'  => 'أدلة',
                'tags'         => ['Software Company Jordan', 'Choose Developer', 'Guide', 'Jordan Tech'],
                'body_en'      => '<h2>Finding the Right Software Development Partner in Jordan</h2>
<p>Jordan has hundreds of software development companies and freelancers, ranging from one-person shops to agencies with 50+ developers. Choosing the wrong partner can waste months and tens of thousands of dinars. This guide gives you a clear framework for making the right decision.</p>

<h2>12 Questions to Ask Before Signing</h2>
<ol>
<li><strong>Can you show me 3 live projects similar to mine?</strong> — Not mockups, actual URLs you can use.</li>
<li><strong>Who specifically will work on my project?</strong> — Know the actual developers, not just the sales team.</li>
<li><strong>Do you have a project manager assigned to my account?</strong> — Communication falls apart without a single point of contact.</li>
<li><strong>What happens if a developer leaves mid-project?</strong> — Process must survive individual team changes.</li>
<li><strong>What tech stack will you use and why?</strong> — Should match your long-term needs, not just what the team knows.</li>
<li><strong>Do you write automated tests?</strong> — No tests = brittle code that breaks when you add features.</li>
<li><strong>How do you handle requirement changes?</strong> — Scope creep kills projects; clear change-request process matters.</li>
<li><strong>Who owns the source code after delivery?</strong> — You must own 100% of the code and data.</li>
<li><strong>Can you provide access to the Git repository?</strong> — Transparency in version history is non-negotiable.</li>
<li><strong>What is your warranty / bug-fix policy after launch?</strong> — Minimum 30 days of free fixes is standard.</li>
<li><strong>Do you provide hosting or help us set it up?</strong> — Know who is responsible for uptime.</li>
<li><strong>Can I speak to 2 previous clients?</strong> — Reference calls reveal what the proposal never shows.</li>
</ol>

<h2>Red Flags to Watch Out For</h2>
<ul>
<li>🚩 No written contract or vague scope of work</li>
<li>🚩 Asking for full payment upfront</li>
<li>🚩 Unusually low quote (2x below market = 2x the risk)</li>
<li>🚩 No portfolio or only showing Figma mockups</li>
<li>🚩 Refusing to provide source code access</li>
<li>🚩 Cannot explain their development process</li>
<li>🚩 No questions about your business goals — only about features</li>
</ul>

<h2>What a Fair Contract Includes</h2>
<ul>
<li>Clear scope of work with feature list and acceptance criteria</li>
<li>Payment milestones tied to deliverables (not calendar dates)</li>
<li>IP ownership clause: you own all code, data, and designs</li>
<li>Warranty period of at least 30 days for bugs</li>
<li>Termination clause with partial payment for work completed</li>
</ul>

<h2>What to Pay</h2>
<p>A fair payment structure for a Jordan software project: 30% on contract signing, 30% at midpoint milestone, 30% at delivery, 10% after go-live review. Be very cautious with any company asking 50%+ upfront.</p>',
                'body_ar'      => '<h2>إيجاد شريك التطوير البرمجي المناسب في الأردن</h2>
<p>يوجد في الأردن مئات شركات البرمجيات والمستقلين، تتراوح من متاجر شخص واحد إلى وكالات بأكثر من 50 مطوراً. اختيار الشريك الخاطئ يمكن أن يضيع أشهراً وعشرات آلاف الدنانير.</p>

<h2>12 سؤالاً يجب طرحها قبل التوقيع</h2>
<ol>
<li><strong>هل يمكنك إظهار 3 مشاريع حية مشابهة لمشروعي؟</strong> — ليس نماذج، بل روابط URL حقيقية يمكنك استخدامها.</li>
<li><strong>من سيعمل تحديداً على مشروعي؟</strong> — اعرف المطورين الفعليين، ليس فقط فريق المبيعات.</li>
<li><strong>هل لديك مدير مشروع مخصص لحسابي؟</strong> — التواصل ينهار بدون نقطة اتصال واحدة.</li>
<li><strong>ماذا يحدث إذا غادر مطور في منتصف المشروع؟</strong></li>
<li><strong>ما المكدس التقني الذي ستستخدمه ولماذا؟</strong></li>
<li><strong>هل تكتب اختبارات آلية؟</strong> — لا اختبارات = كود هش ينكسر عند إضافة ميزات.</li>
<li><strong>من يمتلك الكود المصدري بعد التسليم؟</strong> — يجب أن تمتلك 100% من الكود والبيانات.</li>
</ol>

<h2>العلامات التحذيرية</h2>
<ul>
<li>🚩 لا عقد مكتوب أو نطاق عمل غامض</li>
<li>🚩 طلب الدفع الكامل مقدماً</li>
<li>🚩 عرض سعر منخفض بشكل غير معقول</li>
<li>🚩 لا محفظة أعمال أو يظهر فقط نماذج Figma</li>
<li>🚩 رفض توفير وصول للكود المصدري</li>
</ul>',
            ],

            // ── 5. ERP cost Jordan ─────────────────────────────────────────
            [
                'slug'         => 'erp-system-cost-jordan',
                'title_en'     => 'ERP System Cost in Jordan 2025 — What to Expect',
                'title_ar'     => 'تكلفة نظام ERP في الأردن 2025 — ماذا تتوقع',
                'excerpt_en'   => 'Full cost breakdown for ERP systems in Jordan — from Odoo and SAP licensing to custom Laravel ERP development. Includes implementation, training, and ROI guide.',
                'excerpt_ar'   => 'تفصيل كامل لتكاليف أنظمة ERP في الأردن — من ترخيص Odoo وSAP إلى تطوير ERP مخصص بـLaravel. يشمل التطبيق والتدريب ودليل العائد على الاستثمار.',
                'meta_title_en'=> 'ERP System Cost Jordan 2025 — Odoo SAP Custom | Alien Code',
                'meta_title_ar'=> 'تكلفة نظام ERP في الأردن 2025 | Alien Code',
                'meta_desc_en' => 'How much does an ERP system cost in Jordan? Compare Odoo, SAP, Oracle, and custom Laravel ERP costs. Includes implementation, training, and ongoing support pricing.',
                'meta_desc_ar' => 'كم تكلفة نظام ERP في الأردن؟ قارن تكاليف Odoo وSAP وOracle وERP مخصص بـLaravel. يشمل التطبيق والتدريب والدعم المستمر.',
                'category_en'  => 'Guides',
                'category_ar'  => 'أدلة',
                'tags'         => ['ERP Cost', 'Jordan', 'Odoo', 'SAP', 'Custom ERP'],
                'body_en'      => '<h2>ERP System Costs in Jordan (2025)</h2>
<p>Enterprise Resource Planning (ERP) systems are the backbone of medium and large businesses — managing accounting, HR, inventory, procurement, and operations in one place. In Jordan, ERP adoption has accelerated since 2020, driven by e-invoicing mandates and Jordan Vision 2030 digital transformation goals.</p>

<h2>ERP Options and Cost Comparison</h2>
<table style="width:100%;border-collapse:collapse;">
<thead><tr style="border-bottom:1px solid rgba(255,255,255,.2);">
<th style="text-align:left;padding:.5rem;">ERP System</th>
<th style="text-align:left;padding:.5rem;">License / Year</th>
<th style="text-align:left;padding:.5rem;">Implementation (JOD)</th>
<th style="text-align:left;padding:.5rem;">Best For</th>
</tr></thead>
<tbody>
<tr><td style="padding:.5rem;">Odoo Community</td><td style="padding:.5rem;">Free</td><td style="padding:.5rem;">3,000 – 15,000</td><td style="padding:.5rem;">SMEs, startups</td></tr>
<tr><td style="padding:.5rem;">Odoo Enterprise</td><td style="padding:.5rem;">1,200 – 6,000</td><td style="padding:.5rem;">8,000 – 25,000</td><td style="padding:.5rem;">Growing companies</td></tr>
<tr><td style="padding:.5rem;">Microsoft Dynamics 365</td><td style="padding:.5rem;">6,000 – 30,000</td><td style="padding:.5rem;">20,000 – 80,000</td><td style="padding:.5rem;">Large enterprises</td></tr>
<tr><td style="padding:.5rem;">SAP Business One</td><td style="padding:.5rem;">10,000 – 20,000</td><td style="padding:.5rem;">25,000 – 100,000</td><td style="padding:.5rem;">Mid-market</td></tr>
<tr><td style="padding:.5rem;">Custom Laravel ERP</td><td style="padding:.5rem;">0 (you own it)</td><td style="padding:.5rem;">10,000 – 60,000</td><td style="padding:.5rem;">Unique processes</td></tr>
</tbody>
</table>

<h2>Why Jordan Businesses Choose Custom ERP</h2>
<p>Many Jordanian companies start with Odoo or another package ERP, then migrate to a custom system after 2–3 years because:</p>
<ul>
<li>Odoo customisation cost exceeds the custom build cost</li>
<li>Off-the-shelf systems don\'t integrate with Jordan-specific APIs (e-Invoice, JODDB, Umniah SMS, eFAWATEERcom)</li>
<li>Arabic language support is often an afterthought in international ERP vendors</li>
<li>Data sovereignty concerns — local storage on Jordan servers</li>
</ul>

<h2>What Custom ERP Includes</h2>
<p>A typical Alien Code ERP build includes: accounting module (IFRS-compliant, Jordan chart of accounts), HR and payroll (SSC, income tax per Jordan law), inventory management, procurement, sales CRM, reporting and dashboards, and user roles with audit trail. All data stored on your servers in Jordan.</p>

<h2>ROI Calculation</h2>
<p>A 10-user company paying 500 JD/month in Odoo licenses and spending 20 hours/month manually reconciling data between systems: the manual reconciliation alone costs 20h × 15 JD/h = 300 JD/month. Total cost = 800 JD/month = 9,600 JD/year. A custom ERP at 20,000 JD investment pays for itself in 26 months, then saves 9,600 JD/year.</p>',
                'body_ar'      => '<h2>تكاليف أنظمة ERP في الأردن (2025)</h2>
<p>أنظمة تخطيط موارد المؤسسة (ERP) هي العمود الفقري للأعمال المتوسطة والكبيرة — تدير المحاسبة والموارد البشرية والمخزون والمشتريات والعمليات في مكان واحد.</p>

<h2>مقارنة خيارات ERP والتكاليف</h2>
<table style="width:100%;border-collapse:collapse;">
<thead><tr style="border-bottom:1px solid rgba(255,255,255,.2);">
<th style="text-align:right;padding:.5rem;">نظام ERP</th>
<th style="text-align:right;padding:.5rem;">الترخيص / سنة</th>
<th style="text-align:right;padding:.5rem;">التطبيق (د.أ)</th>
</tr></thead>
<tbody>
<tr><td style="padding:.5rem;text-align:right;">Odoo Community</td><td style="padding:.5rem;text-align:right;">مجاني</td><td style="padding:.5rem;text-align:right;">3,000 – 15,000</td></tr>
<tr><td style="padding:.5rem;text-align:right;">Odoo Enterprise</td><td style="padding:.5rem;text-align:right;">1,200 – 6,000</td><td style="padding:.5rem;text-align:right;">8,000 – 25,000</td></tr>
<tr><td style="padding:.5rem;text-align:right;">SAP Business One</td><td style="padding:.5rem;text-align:right;">10,000 – 20,000</td><td style="padding:.5rem;text-align:right;">25,000 – 100,000</td></tr>
<tr><td style="padding:.5rem;text-align:right;">ERP مخصص بـLaravel</td><td style="padding:.5rem;text-align:right;">0 (تملكه أنت)</td><td style="padding:.5rem;text-align:right;">10,000 – 60,000</td></tr>
</tbody>
</table>

<h2>لماذا الأعمال الأردنية تختار ERP مخصصاً؟</h2>
<ul>
<li>تكلفة تخصيص Odoo تتجاوز تكلفة البناء المخصص</li>
<li>الأنظمة الجاهزة لا تتكامل مع APIs الأردنية (الفاتورة الإلكترونية، eFAWATEERcom)</li>
<li>دعم اللغة العربية غالباً ما يكون فكرة لاحقة في بائعي ERP الدوليين</li>
<li>مخاوف سيادة البيانات — تخزين محلي على خوادم أردنية</li>
</ul>',
            ],
        ];
    }
}
