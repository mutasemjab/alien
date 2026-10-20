<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Enriches existing Service records with SEO slugs, detailed body content,
 * and meta tags. Uses title_en as a stable ownership key.
 *
 * Safe to run repeatedly — uses updateOrCreate per slug and only touches
 * records it can identify by title_en.
 */
class SeoServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = $this->serviceData();
        $created  = 0;
        $updated  = 0;
        $skipped  = 0;

        DB::transaction(function () use ($services, &$created, &$updated, &$skipped) {
            foreach ($services as $data) {
                $existing = Service::where('title_en', $data['title_en'])->first();

                if (! $existing) {
                    // Service not found by title — create it fresh
                    $slugBase = \Illuminate\Support\Str::slug($data['title_en']);
                    $slug     = $this->uniqueSlug($slugBase);

                    Service::create(array_merge($data, ['slug' => $slug, 'is_active' => true]));
                    $created++;
                    continue;
                }

                // Service exists — update SEO fields only; preserve icon, sort_order, is_active
                if (! empty($existing->slug) && $existing->slug !== \Illuminate\Support\Str::slug($data['title_en'])) {
                    // Another record already owns a different slug — skip to avoid conflict
                    $this->command->warn("  SKIP  [{$existing->title_en}] — already has slug [{$existing->slug}]");
                    $skipped++;
                    continue;
                }

                $slug = $existing->slug ?: $this->uniqueSlug(\Illuminate\Support\Str::slug($data['title_en']), $existing->id);

                $existing->update([
                    'slug'          => $slug,
                    'body_en'       => $data['body_en'],
                    'body_ar'       => $data['body_ar'],
                    'meta_title_en' => $data['meta_title_en'],
                    'meta_title_ar' => $data['meta_title_ar'],
                    'meta_desc_en'  => $data['meta_desc_en'],
                    'meta_desc_ar'  => $data['meta_desc_ar'],
                ]);
                $updated++;
            }
        });

        $this->command->info("  SeoServicesSeeder: {$created} created, {$updated} updated, {$skipped} skipped.");
    }

    private function uniqueSlug(string $base, ?int $excludeId = null): string
    {
        $slug  = $base;
        $i     = 1;
        $query = Service::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        while ($query->clone()->exists()) {
            $slug  = "{$base}-{$i}";
            $i++;
            $query = Service::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }
        return $slug;
    }

    private function serviceData(): array
    {
        return [
            // ── Web Development ──────────────────────────────────────────
            [
                'title_en'       => 'Web Development',
                'title_ar'       => 'تطوير الويب',
                'description_en' => 'Crafting pixel-perfect, blazing-fast web applications with cutting-edge frameworks that convert visitors into customers.',
                'description_ar' => 'بناء تطبيقات ويب سريعة ومتقنة بأحدث الأطر التقنية تحوّل الزوار إلى عملاء.',
                'icon'           => '🌐',
                'tags'           => ['React', 'Next.js', 'Vue', 'TypeScript', 'Laravel', 'Node.js'],
                'sort_order'     => 0,
                'meta_title_en'  => 'Web Development Services in Jordan | Alien Code Amman',
                'meta_title_ar'  => 'خدمات تطوير الويب في الأردن | Alien Code عمّان',
                'meta_desc_en'   => 'Alien Code delivers professional web development services in Jordan — Laravel, Vue.js, React, and Node.js. We build fast, scalable web applications for businesses in Amman and the Middle East.',
                'meta_desc_ar'   => 'يقدم Alien Code خدمات تطوير الويب الاحترافية في الأردن — لارافيل وVue.js وReact وNode.js. نبني تطبيقات ويب سريعة وقابلة للتوسع للشركات في عمّان والشرق الأوسط.',
                'body_en'        => $this->webDevBodyEn(),
                'body_ar'        => $this->webDevBodyAr(),
            ],

            // ── Mobile Apps ──────────────────────────────────────────────
            [
                'title_en'       => 'Mobile Apps',
                'title_ar'       => 'تطبيقات الجوال',
                'description_en' => 'Native and cross-platform mobile experiences that delight users on iOS and Android — from MVP to enterprise scale.',
                'description_ar' => 'تطبيقات جوال متميزة تعمل على iOS وAndroid من المرحلة الأولى حتى المستوى المؤسسي.',
                'icon'           => '📱',
                'tags'           => ['Flutter', 'Swift', 'Kotlin', 'React Native'],
                'sort_order'     => 1,
                'meta_title_en'  => 'Mobile App Development Jordan | iOS & Android — Alien Code',
                'meta_title_ar'  => 'تطوير تطبيقات الجوال في الأردن | iOS وAndroid — Alien Code',
                'meta_desc_en'   => 'Alien Code builds custom iOS and Android mobile apps for businesses in Jordan. React Native, Flutter, Swift, and Kotlin development. Get a free project estimate.',
                'meta_desc_ar'   => 'يبني Alien Code تطبيقات جوال iOS وAndroid مخصصة للشركات في الأردن. تطوير React Native وFlutter وSwift وKotlin.',
                'body_en'        => $this->mobileBodyEn(),
                'body_ar'        => $this->mobileBodyAr(),
            ],

            // ── AI & Machine Learning ────────────────────────────────────
            [
                'title_en'       => 'AI & Machine Learning',
                'title_ar'       => 'الذكاء الاصطناعي',
                'description_en' => 'Custom LLM integrations, computer vision, NLP, and predictive analytics that make your product smarter every day.',
                'description_ar' => 'نماذج LLM مخصصة، رؤية حاسوبية، معالجة اللغة الطبيعية وتحليلات تنبؤية تجعل منتجك أكثر ذكاءً كل يوم.',
                'icon'           => '🤖',
                'tags'           => ['Python', 'TensorFlow', 'LLM', 'PyTorch', 'OpenAI'],
                'sort_order'     => 2,
                'meta_title_en'  => 'AI & Machine Learning Development Jordan | Alien Code',
                'meta_title_ar'  => 'تطوير الذكاء الاصطناعي وتعلم الآلة في الأردن | Alien Code',
                'meta_desc_en'   => 'Alien Code delivers AI and machine learning solutions for businesses in Jordan — NLP, computer vision, predictive analytics, and LLM integrations.',
                'meta_desc_ar'   => 'يقدم Alien Code حلول الذكاء الاصطناعي وتعلم الآلة للشركات في الأردن — معالجة اللغة الطبيعية ورؤية الحاسوب والتحليلات التنبؤية.',
                'body_en'        => $this->aiBodyEn(),
                'body_ar'        => $this->aiBodyAr(),
            ],

            // ── Custom Software / ERP ────────────────────────────────────
            [
                'title_en'       => 'Custom Software & ERP',
                'title_ar'       => 'برمجة مخصصة وأنظمة ERP',
                'description_en' => 'Tailor-made business management systems, ERP, and workflow automation that replace generic tools with solutions built around your exact processes.',
                'description_ar' => 'أنظمة إدارة أعمال مخصصة وERP وأتمتة سير العمل تحل محل الأدوات الجاهزة بحلول مبنية حول عملياتك بالضبط.',
                'icon'           => '⚙️',
                'tags'           => ['ERP', 'Laravel', 'Vue.js', 'PostgreSQL', 'Workflow'],
                'sort_order'     => 5,
                'meta_title_en'  => 'Custom Software & ERP Development Jordan | Alien Code',
                'meta_title_ar'  => 'تطوير برمجيات مخصصة وأنظمة ERP في الأردن | Alien Code',
                'meta_desc_en'   => 'Alien Code builds custom ERP systems and business management software for companies in Jordan. Replace spreadsheets and generic tools with a system built for your workflow.',
                'meta_desc_ar'   => 'يبني Alien Code أنظمة ERP مخصصة وبرامج إدارة الأعمال للشركات في الأردن. استبدل جداول البيانات والأدوات الجاهزة بنظام مبني لعملك.',
                'body_en'        => $this->erpBodyEn(),
                'body_ar'        => $this->erpBodyAr(),
            ],

            // ── E-commerce ───────────────────────────────────────────────
            [
                'title_en'       => 'E-commerce Development',
                'title_ar'       => 'تطوير التجارة الإلكترونية',
                'description_en' => 'High-converting custom e-commerce platforms with Arabic UX, local payment gateways, and inventory management built for the Jordanian and MENA market.',
                'description_ar' => 'منصات تجارة إلكترونية مخصصة عالية التحويل مع واجهة مستخدم عربية وبوابات دفع محلية وإدارة مخزون للسوق الأردني ومنطقة الشرق الأوسط.',
                'icon'           => '🛒',
                'tags'           => ['Laravel', 'Vue.js', 'eFAWATEERcom', 'Hyperpay', 'PayFort'],
                'sort_order'     => 6,
                'meta_title_en'  => 'E-commerce Development Jordan | Custom Online Stores — Alien Code',
                'meta_title_ar'  => 'تطوير التجارة الإلكترونية في الأردن | متاجر إلكترونية مخصصة — Alien Code',
                'meta_desc_en'   => 'Alien Code builds custom e-commerce platforms for Jordanian businesses — Arabic UX, local payment gateways (eFAWATEERcom, Hyperpay), and scalable Laravel backends.',
                'meta_desc_ar'   => 'يبني Alien Code منصات تجارة إلكترونية مخصصة للشركات الأردنية — واجهة مستخدم عربية وبوابات دفع محلية وخلفيات Laravel قابلة للتوسع.',
                'body_en'        => $this->ecomBodyEn(),
                'body_ar'        => $this->ecomBodyAr(),
            ],
        ];
    }

    // ── Body content methods ─────────────────────────────────────────────

    private function webDevBodyEn(): string
    {
        return <<<HTML
<h2>Web Development That Drives Business Results</h2>
<p>At Alien Code, we do not simply build websites — we engineer web applications that become competitive advantages for our clients. Our Amman-based development team combines technical depth with a genuine understanding of the Jordanian and MENA business environment to deliver web solutions that perform, scale, and convert.</p>

<h2>Our Web Development Stack</h2>
<ul>
  <li><strong>Frontend:</strong> Vue.js, React, Next.js, Nuxt.js, TypeScript — with a focus on Core Web Vitals performance</li>
  <li><strong>Backend:</strong> Laravel (PHP), Node.js (Fastify/Express) — for robust, secure APIs and server-side logic</li>
  <li><strong>Database:</strong> PostgreSQL, MySQL, Redis — designed for longevity and query performance</li>
  <li><strong>Hosting:</strong> AWS, DigitalOcean, Cloudflare — with automated CI/CD pipelines</li>
</ul>

<h2>What We Build</h2>
<h3>Corporate Websites &amp; Landing Pages</h3>
<p>Server-rendered, SEO-optimized websites built with Laravel + Blade or Nuxt.js. Fast initial load, clean semantic HTML, and fully bilingual Arabic/English support.</p>

<h3>SaaS Platforms</h3>
<p>Multi-tenant web applications with subscription billing, role-based access, and the scalability to grow from 100 to 100,000 users without re-architecting.</p>

<h3>Web Portals &amp; Dashboards</h3>
<p>Complex internal tools, B2B portals, and data-driven dashboards with real-time updates, export capabilities, and enterprise-grade security.</p>

<h3>API Development &amp; Integration</h3>
<p>RESTful and GraphQL APIs, third-party integrations (payment gateways, CRMs, ERPs, government portals), and webhook-driven automation.</p>

<h2>Arabic-First Development</h2>
<p>Every web application we build supports full RTL layout, Arabic typography, and locale-aware formatting. We understand that the Jordanian market requires more than a translated interface — it requires a culturally aware user experience.</p>

<h2>Our Development Process</h2>
<ol>
  <li><strong>Discovery:</strong> requirements mapping, technical architecture, and timeline planning</li>
  <li><strong>Design:</strong> wireframes and high-fidelity UI with your brand identity</li>
  <li><strong>Development:</strong> agile sprints with weekly demos and continuous feedback</li>
  <li><strong>Testing:</strong> automated test suites, performance benchmarking, security audit</li>
  <li><strong>Launch:</strong> zero-downtime deployment with rollback capability</li>
  <li><strong>Support:</strong> ongoing maintenance, performance monitoring, and feature development</li>
</ol>

<h2>Ready to Build?</h2>
<p>Contact Alien Code for a free technical consultation. We will scope your project, recommend the right technology stack, and provide a transparent fixed-price or time-and-materials proposal.</p>
HTML;
    }

    private function webDevBodyAr(): string
    {
        return <<<HTML
<h2>تطوير ويب يحقق نتائج أعمال فعلية</h2>
<p>في Alien Code، لا نبني مواقع إلكترونية فحسب — بل نهندس تطبيقات ويب تتحول إلى ميزة تنافسية لعملائنا. يجمع فريق التطوير لدينا في عمّان بين العمق التقني وفهم حقيقي لبيئة الأعمال الأردنية ومنطقة الشرق الأوسط لتقديم حلول ويب تؤدي وظيفتها وتتوسع وتحول الزوار إلى عملاء.</p>

<h2>مكدس تطوير الويب لدينا</h2>
<ul>
  <li><strong>الواجهة الأمامية:</strong> Vue.js وReact وNext.js وNuxt.js وTypeScript</li>
  <li><strong>الخلفية:</strong> Laravel (PHP) وNode.js لواجهات برمجية قوية وآمنة</li>
  <li><strong>قواعد البيانات:</strong> PostgreSQL وMySQL وRedis</li>
  <li><strong>الاستضافة:</strong> AWS وDigitalOcean وCloudflare</li>
</ul>

<h2>ما نبنيه</h2>
<h3>المواقع المؤسسية وصفحات الهبوط</h3>
<p>مواقع مُحسَّنة لمحركات البحث مبنية بـ Laravel + Blade أو Nuxt.js. تحميل سريع، وHTML دلالي نظيف، ودعم كامل للعربية والإنجليزية.</p>

<h3>منصات SaaS</h3>
<p>تطبيقات ويب متعددة المستأجرين مع فوترة الاشتراكات والتحكم في الأدوار وقابلية التوسع من 100 إلى 100,000 مستخدم دون إعادة بناء.</p>

<h2>هل أنت مستعد للبناء؟</h2>
<p>تواصل مع Alien Code للحصول على استشارة تقنية مجانية. سنحدد نطاق مشروعك ونوصي بمكدس التقنيات المناسب ونقدم عرضاً شفافاً بسعر ثابت أو حسب الوقت والمواد.</p>
HTML;
    }

    private function mobileBodyEn(): string
    {
        return <<<HTML
<h2>Mobile Apps That Users Actually Love</h2>
<p>A great mobile app is more than functional — it is fast, intuitive, and feels native to the platform it runs on. Alien Code's mobile team in Amman has delivered iOS and Android applications for clients across Jordan, Saudi Arabia, and the UAE, across industries ranging from healthcare to logistics to fintech.</p>

<h2>Cross-Platform vs. Native: Our Recommendation</h2>
<h3>React Native</h3>
<p>Our default recommendation for most business applications. One JavaScript codebase, near-native performance on both iOS and Android, and significantly faster development than building two native apps. Best for: marketplaces, e-commerce, service apps, enterprise mobility tools.</p>

<h3>Flutter</h3>
<p>When pixel-perfect UI consistency across iOS, Android, and web is the priority. Dart's compilation model delivers excellent animation performance. Best for: design-forward consumer apps and real-time interfaces.</p>

<h3>Native Swift &amp; Kotlin</h3>
<p>When you need deep platform integration — ARKit, NFC, Bluetooth LE, or platform-specific sensor access. Best for: hardware-adjacent apps, high-performance games, and apps requiring proprietary SDK integration.</p>

<h2>What Our Mobile Apps Include</h2>
<ul>
  <li>Arabic RTL support and bilingual content management</li>
  <li>Backend API built with Laravel (RESTful or GraphQL)</li>
  <li>Push notifications (FCM/APNs)</li>
  <li>Offline capability with local data sync</li>
  <li>Analytics integration (Firebase, Mixpanel)</li>
  <li>App Store and Google Play submission management</li>
  <li>Post-launch monitoring and iterative updates</li>
</ul>

<h2>Industries We Serve in Jordan</h2>
<p>E-commerce and retail, healthcare and telemedicine, on-demand delivery, real estate, education, logistics and fleet management, fintech and digital wallets.</p>

<h2>Start Your Mobile Project</h2>
<p>Tell us about your app idea and we will provide a free technical assessment, platform recommendation, and development estimate.</p>
HTML;
    }

    private function mobileBodyAr(): string
    {
        return <<<HTML
<h2>تطبيقات جوال يحبها المستخدمون فعلاً</h2>
<p>التطبيق الجوال الرائع أكثر من مجرد وظيفي — إنه سريع وبديهي ويشعر بأنه أصيل على المنصة التي يعمل عليها. قدّم فريق الجوال لدى Alien Code في عمّان تطبيقات iOS وAndroid لعملاء في الأردن والسعودية والإمارات، في قطاعات تتراوح بين الرعاية الصحية والخدمات اللوجستية والتكنولوجيا المالية.</p>

<h2>ما تشمله تطبيقات الجوال لدينا</h2>
<ul>
  <li>دعم RTL العربي وإدارة المحتوى ثنائي اللغة</li>
  <li>API خلفي مبني بـ Laravel</li>
  <li>إشعارات دفع</li>
  <li>إمكانية العمل دون اتصال مع مزامنة البيانات المحلية</li>
  <li>إدارة إرسال إلى App Store وGoogle Play</li>
</ul>

<h2>ابدأ مشروع الجوال الخاص بك</h2>
<p>أخبرنا عن فكرة تطبيقك وسنقدم تقييماً تقنياً مجانياً وتوصية بالمنصة وتقديراً للتطوير.</p>
HTML;
    }

    private function aiBodyEn(): string
    {
        return <<<HTML
<h2>AI Solutions Built for the MENA Market</h2>
<p>Artificial intelligence is no longer a competitive differentiator reserved for global tech giants. Alien Code makes practical AI accessible to businesses in Jordan and the wider Middle East — integrating machine learning directly into your existing systems, workflows, and products.</p>

<h2>Our AI Service Areas</h2>
<h3>Natural Language Processing (NLP)</h3>
<p>Arabic-first NLP pipelines for sentiment analysis, text classification, named entity recognition, and conversational AI. We understand the linguistic complexity of Arabic dialects, including Levantine Arabic used in Jordan.</p>

<h3>Predictive Analytics &amp; Machine Learning</h3>
<p>Demand forecasting, customer churn prediction, fraud detection, and pricing optimization. We integrate ML models directly into your ERP, CRM, or e-commerce platform — no separate data science dashboard required.</p>

<h3>Computer Vision</h3>
<p>Document digitization and Arabic OCR, product image recognition for retail, quality control automation for manufacturing, and real-time detection systems for logistics.</p>

<h3>LLM Integration &amp; AI Automation</h3>
<p>Custom ChatGPT-style interfaces trained on your knowledge base, AI agents that automate complex multi-step business processes, and RAG (retrieval-augmented generation) systems for enterprise knowledge management.</p>

<h2>Our AI Technology Stack</h2>
<ul>
  <li>Python, FastAPI, LangChain, LlamaIndex</li>
  <li>OpenAI API, Anthropic Claude, open-source LLMs (Mistral, LLaMA)</li>
  <li>PyTorch, TensorFlow, Hugging Face Transformers</li>
  <li>PostgreSQL + pgvector, Pinecone (vector databases)</li>
</ul>

<h2>Discuss Your AI Project</h2>
<p>We offer a free AI discovery workshop to identify the highest-impact opportunities in your business. No commitment required — just an honest conversation about what is technically feasible and commercially viable for your specific situation.</p>
HTML;
    }

    private function aiBodyAr(): string
    {
        return <<<HTML
<h2>حلول الذكاء الاصطناعي المبنية لسوق الشرق الأوسط</h2>
<p>لم يعد الذكاء الاصطناعي ميزة تنافسية مقتصرة على عمالقة التقنية العالميين. يجعل Alien Code الذكاء الاصطناعي العملي متاحاً للشركات في الأردن ومنطقة الشرق الأوسط الأوسع — من خلال دمج تعلم الآلة مباشرة في أنظمتك وسير عملك ومنتجاتك الحالية.</p>

<h2>مجالات خدمات الذكاء الاصطناعي لدينا</h2>
<h3>معالجة اللغة الطبيعية</h3>
<p>خطوط معالجة لغة طبيعية تضع العربية في المقدمة لتحليل المشاعر وتصنيف النصوص والتعرف على الكيانات المسماة والذكاء الاصطناعي الحواري. نفهم التعقيد اللغوي للهجات العربية، بما فيها اللهجة الشامية المستخدمة في الأردن.</p>

<h3>التحليلات التنبؤية وتعلم الآلة</h3>
<p>توقع الطلب، والتنبؤ بتراجع العملاء، وكشف الاحتيال، وتحسين التسعير. ندمج نماذج تعلم الآلة مباشرة في نظام ERP أو CRM أو منصة التجارة الإلكترونية الخاصة بك.</p>

<h2>ناقش مشروع الذكاء الاصطناعي الخاص بك</h2>
<p>نقدم ورشة اكتشاف ذكاء اصطناعي مجانية لتحديد أعلى الفرص تأثيراً في عملك. لا يلزم أي التزام — مجرد محادثة صادقة حول ما هو ممكن تقنياً ومجدٍ تجارياً لوضعك المحدد.</p>
HTML;
    }

    private function erpBodyEn(): string
    {
        return <<<HTML
<h2>Stop Adapting to Your Software — Build Software That Adapts to You</h2>
<p>Every business has processes that off-the-shelf ERP systems cannot accommodate without expensive customizations, workarounds, or data migrations. Alien Code builds custom business management systems from the ground up — designed around your exact workflow, not a generic template.</p>

<h2>What We Build</h2>
<h3>Custom ERP Systems</h3>
<p>Full enterprise resource planning systems covering inventory management, procurement, production planning, financial accounting, HR, and reporting — integrated into a single platform built for your business model.</p>

<h3>Warehouse &amp; Inventory Management</h3>
<p>Real-time stock tracking, multi-warehouse management, barcode and QR integration, reorder automation, and supplier portal connectivity. Designed for Jordanian manufacturing, retail, and distribution businesses.</p>

<h3>CRM &amp; Sales Pipeline Management</h3>
<p>Custom customer relationship management tailored to your sales process — lead tracking, quotation management, contract lifecycle, and commission calculation.</p>

<h3>HR &amp; Payroll Systems</h3>
<p>Employee management, attendance tracking, leave management, and payroll calculation compliant with Jordanian labor law and Social Security contribution requirements.</p>

<h3>Workflow Automation</h3>
<p>Multi-step approval workflows, automated notifications, document generation, and integration with government portals — eliminating manual data entry across your organization.</p>

<h2>Why Custom Over Packaged ERP?</h2>
<p>Packaged ERP systems (SAP, Oracle, Odoo) are designed for thousands of businesses. A custom system is designed for one: yours. The result is faster adoption, no licensing fees, and a system that evolves as your business evolves.</p>

<h2>Request a Free ERP Consultation</h2>
<p>Describe your current system challenges and we will assess whether a custom solution is the right fit, provide a realistic scope, and outline a phased implementation plan.</p>
HTML;
    }

    private function erpBodyAr(): string
    {
        return <<<HTML
<h2>توقف عن التكيّف مع برمجياتك — ابنِ برمجيات تتكيف معك</h2>
<p>كل شركة لديها عمليات لا تستطيع أنظمة ERP الجاهزة استيعابها دون تخصيصات مكلفة أو حلول بديلة أو ترحيل بيانات. يبني Alien Code أنظمة إدارة أعمال مخصصة من الصفر — مصممة حول سير عملك بالضبط، وليس قالباً عاماً.</p>

<h2>ما نبنيه</h2>
<h3>أنظمة ERP المخصصة</h3>
<p>أنظمة تخطيط موارد مؤسسية كاملة تغطي إدارة المخزون والمشتريات وتخطيط الإنتاج والمحاسبة المالية والموارد البشرية والتقارير.</p>

<h3>إدارة المستودعات والمخزون</h3>
<p>تتبع المخزون في الوقت الفعلي، وإدارة المستودعات المتعددة، وتكامل الباركود وQR، وأتمتة إعادة الطلب. مصمم للتصنيع والتجزئة والتوزيع في الأردن.</p>

<h2>اطلب استشارة ERP مجانية</h2>
<p>صِف تحديات نظامك الحالي وسنقيّم ما إذا كان الحل المخصص هو الخيار المناسب ونقدم نطاقاً واقعياً وخطة تنفيذ مرحلية.</p>
HTML;
    }

    private function ecomBodyEn(): string
    {
        return <<<HTML
<h2>E-commerce Built for the Jordanian and MENA Market</h2>
<p>The Jordanian e-commerce market has unique requirements that global platforms often fail to address: Arabic-first UX, cash-on-delivery workflows, local payment gateway integration, and the trust signals that Jordanian consumers respond to. Alien Code builds custom e-commerce platforms that address these requirements natively.</p>

<h2>What Sets Our E-commerce Builds Apart</h2>
<h3>Arabic-First User Experience</h3>
<p>Full RTL layout, Arabic typography, locale-aware number and currency formatting, and culturally appropriate design patterns — not a translated version of an English interface.</p>

<h3>Local Payment Gateway Integration</h3>
<p>We integrate with eFAWATEERcom, Hyperpay, PayFort, MyFatoorah, and Fawry. Cash on delivery remains critical in Jordan — our platforms handle COD workflows, reconciliation, and driver confirmation natively.</p>

<h3>Scalable Laravel + Vue.js Architecture</h3>
<p>Server-side rendering for SEO performance, Redis-cached product listings for fast page loads, and a headless API architecture that supports mobile apps, third-party marketplaces, and future expansion.</p>

<h3>Inventory &amp; Order Management</h3>
<p>Real-time stock management, multi-warehouse support, return and refund workflows, and a supplier portal for B2B ordering. Built to replace spreadsheets and disconnected tools.</p>

<h2>E-commerce Features We Commonly Build</h2>
<ul>
  <li>Product catalog with variants, bundles, and digital downloads</li>
  <li>Advanced search with Arabic language support</li>
  <li>Loyalty programs and referral systems</li>
  <li>Abandoned cart recovery</li>
  <li>B2B account-based pricing and purchase order workflows</li>
  <li>Seller marketplace (multi-vendor)</li>
  <li>Integration with Jordanian logistics providers</li>
</ul>

<h2>Build Your E-commerce Platform</h2>
<p>Contact Alien Code to discuss your e-commerce vision. We will assess your requirements, recommend the right architecture, and provide a detailed development proposal.</p>
HTML;
    }

    private function ecomBodyAr(): string
    {
        return <<<HTML
<h2>تجارة إلكترونية مبنية للسوق الأردني ومنطقة الشرق الأوسط</h2>
<p>يتميز سوق التجارة الإلكترونية الأردني بمتطلبات فريدة كثيراً ما تفشل المنصات العالمية في تلبيتها: تجربة مستخدم عربية بالدرجة الأولى، وسير عمل الدفع نقداً عند التسليم، وتكامل بوابات الدفع المحلية. يبني Alien Code منصات تجارة إلكترونية مخصصة تلبي هذه المتطلبات بشكل أصيل.</p>

<h2>ما يميز منصاتنا للتجارة الإلكترونية</h2>
<h3>تجربة مستخدم عربية أولاً</h3>
<p>تخطيط RTL كامل، وطباعة عربية، وتنسيق أرقام وعملات يدرك الموقع الجغرافي، وأنماط تصميم مناسبة ثقافياً.</p>

<h3>تكامل بوابات الدفع المحلية</h3>
<p>ندمج مع eFAWATEERcom وHyperpay وPayFort وMyFatoorah. يظل الدفع نقداً عند التسليم أمراً حيوياً في الأردن — تتعامل منصاتنا مع سير عمل الدفع نقداً والتسوية وتأكيد السائق بشكل أصيل.</p>

<h2>ابنِ منصة التجارة الإلكترونية الخاصة بك</h2>
<p>تواصل مع Alien Code لمناقشة رؤيتك للتجارة الإلكترونية. سنقيّم متطلباتك ونوصي بالبنية المناسبة ونقدم مقترح تطوير مفصلاً.</p>
HTML;
    }
}
