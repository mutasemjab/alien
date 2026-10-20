<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Seeds SEO-optimised landing pages using the blogs table with type='landing_page'.
 *
 * Safety guarantees:
 *  - Uses slug as the stable unique key — never duplicates.
 *  - Never deletes or truncates existing records.
 *  - Skips any slug that already exists in the database.
 */
class SeoLandingPagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages   = $this->pages();
        $created = 0;
        $skipped = 0;

        DB::transaction(function () use ($pages, &$created, &$skipped) {
            foreach ($pages as $data) {
                $data['type'] = 'landing_page';

                if (is_array($data['tags'])) {
                    $data['tags'] = json_encode($data['tags']);
                }

                if (Blog::where('slug', $data['slug'])->exists()) {
                    $this->command->line("  SKIP  [{$data['slug']}] — slug already exists.");
                    $skipped++;
                    continue;
                }

                if (Blog::where('title_en', $data['title_en'])->exists()) {
                    $this->command->warn("  SKIP  [{$data['slug']}] — title_en already exists.");
                    $skipped++;
                    continue;
                }

                Blog::create($data);
                $created++;
            }
        });

        $this->command->info("  SeoLandingPagesSeeder: {$created} created, {$skipped} skipped.");
    }

    private function pages(): array
    {
        return [

            // ─────────────────────────────────────────────────────────────
            // LP1 — Software Development Company Jordan (EN primary)
            // ─────────────────────────────────────────────────────────────
            [
                'slug'         => 'software-development-company-jordan',
                'title_en'     => 'Software Development Company in Jordan | Alien Code',
                'title_ar'     => 'شركة تطوير برمجيات في الأردن | Alien Code',
                'excerpt_en'   => 'Alien Code is a Jordan-based software development company delivering custom web applications, mobile apps, ERP systems, and AI solutions for businesses in Amman and across the Middle East.',
                'excerpt_ar'   => 'Alien Code شركة تطوير برمجيات مقرها الأردن تقدم تطبيقات ويب مخصصة وتطبيقات جوال وأنظمة ERP وحلول ذكاء اصطناعي للشركات في عمّان وعبر الشرق الأوسط.',
                'body_en'      => $this->lpSoftwareDevJordanEn(),
                'body_ar'      => $this->lpSoftwareDevJordanAr(),
                'category_en'  => 'Company',
                'category_ar'  => 'الشركة',
                'tags'         => ['Software Development', 'Jordan', 'Amman', 'Custom Software', 'Web Development'],
                'author'       => 'Alien Code',
                'meta_title_en'=> 'Software Development Company in Jordan | Alien Code Amman',
                'meta_title_ar'=> 'شركة تطوير برمجيات في الأردن | Alien Code عمّان',
                'meta_desc_en' => 'Alien Code is a leading software development company in Jordan. We build custom web apps, mobile apps, ERP systems, and AI solutions for businesses in Amman and the Middle East.',
                'meta_desc_ar' => 'Alien Code شركة تطوير برمجيات رائدة في الأردن. نبني تطبيقات ويب وجوال وأنظمة ERP وحلول ذكاء اصطناعي مخصصة للشركات في عمّان والشرق الأوسط.',
                'is_active'    => true,
                'published_at' => Carbon::now()->subDays(45),
                'sort_order'   => 1,
            ],

            // ─────────────────────────────────────────────────────────────
            // LP2 — شركة برمجة في الأردن (AR primary)
            // ─────────────────────────────────────────────────────────────
            [
                'slug'         => 'sharikat-barmajat-fi-alaordon',
                'title_en'     => 'Software Company in Jordan | Alien Code',
                'title_ar'     => 'شركة برمجة في الأردن | Alien Code',
                'excerpt_en'   => 'Looking for a trusted software company in Jordan? Alien Code has been building custom software, websites, mobile apps, and business systems for Jordanian companies since 2016.',
                'excerpt_ar'   => 'تبحث عن شركة برمجة موثوقة في الأردن؟ Alien Code تبني برمجيات مخصصة ومواقع وتطبيقات جوال وأنظمة أعمال للشركات الأردنية منذ 2016.',
                'body_en'      => $this->lpSoftwareCompanyArEn(),
                'body_ar'      => $this->lpSoftwareCompanyArAr(),
                'category_en'  => 'Company',
                'category_ar'  => 'الشركة',
                'tags'         => ['شركة برمجة', 'الأردن', 'عمّان', 'برمجيات', 'Software Company'],
                'author'       => 'Alien Code',
                'meta_title_en'=> 'Software Company in Jordan — Alien Code Amman',
                'meta_title_ar'=> 'شركة برمجة في الأردن — Alien Code عمّان',
                'meta_desc_en' => 'Alien Code is a trusted software company in Jordan with a proven track record in web development, mobile apps, and custom business software. Based in Amman.',
                'meta_desc_ar' => 'Alien Code شركة برمجة موثوقة في الأردن بسجل حافل في تطوير الويب وتطبيقات الجوال والبرمجيات المخصصة. مقرها عمّان.',
                'is_active'    => true,
                'published_at' => Carbon::now()->subDays(42),
                'sort_order'   => 2,
            ],

            // ─────────────────────────────────────────────────────────────
            // LP3 — Web Development Company Jordan
            // ─────────────────────────────────────────────────────────────
            [
                'slug'         => 'web-development-company-jordan',
                'title_en'     => 'Web Development Company in Jordan | Alien Code',
                'title_ar'     => 'شركة تطوير مواقع إلكترونية في الأردن | Alien Code',
                'excerpt_en'   => 'Alien Code is a web development company based in Amman, Jordan. We build custom websites, web applications, and e-commerce platforms for businesses across Jordan and the Middle East.',
                'excerpt_ar'   => 'Alien Code شركة تطوير مواقع إلكترونية مقرها عمّان، الأردن. نبني مواقع مخصصة وتطبيقات ويب ومنصات تجارة إلكترونية للشركات في الأردن والشرق الأوسط.',
                'body_en'      => $this->lpWebDevJordanEn(),
                'body_ar'      => $this->lpWebDevJordanAr(),
                'category_en'  => 'Web Development',
                'category_ar'  => 'تطوير الويب',
                'tags'         => ['Web Development', 'Jordan', 'Amman', 'Website', 'Laravel'],
                'author'       => 'Alien Code',
                'meta_title_en'=> 'Web Development Company in Jordan | Alien Code Amman',
                'meta_title_ar'=> 'شركة تطوير مواقع إلكترونية في الأردن | Alien Code عمّان',
                'meta_desc_en' => 'Alien Code is a web development company in Jordan. We build professional websites, web apps, and e-commerce platforms with Laravel, Vue.js, and React for Jordanian businesses.',
                'meta_desc_ar' => 'Alien Code شركة تطوير مواقع إلكترونية في الأردن. نبني مواقع احترافية وتطبيقات ويب ومنصات تجارة إلكترونية بـ Laravel وVue.js وReact للشركات الأردنية.',
                'is_active'    => true,
                'published_at' => Carbon::now()->subDays(40),
                'sort_order'   => 3,
            ],

            // ─────────────────────────────────────────────────────────────
            // LP4 — شركة تصميم مواقع في الأردن (AR)
            // ─────────────────────────────────────────────────────────────
            [
                'slug'         => 'sharikat-tasmim-mawaqe-fi-alaordon',
                'title_en'     => 'Website Design and Development Company in Jordan',
                'title_ar'     => 'شركة تصميم وتطوير مواقع إلكترونية في الأردن',
                'excerpt_en'   => 'Professional website design and development for Jordanian businesses. Alien Code delivers bilingual Arabic/English websites, optimized for performance and search engines.',
                'excerpt_ar'   => 'تصميم وتطوير مواقع إلكترونية احترافية للشركات الأردنية. يقدم Alien Code مواقع ثنائية اللغة عربي/إنجليزي محسّنة للأداء ومحركات البحث.',
                'body_en'      => $this->lpWebDesignArEn(),
                'body_ar'      => $this->lpWebDesignArAr(),
                'category_en'  => 'Web Development',
                'category_ar'  => 'تطوير الويب',
                'tags'         => ['تصميم مواقع', 'الأردن', 'عمّان', 'Website Design'],
                'author'       => 'Alien Code',
                'meta_title_en'=> 'Website Design & Development Company in Jordan | Alien Code',
                'meta_title_ar'=> 'شركة تصميم وتطوير مواقع إلكترونية في الأردن | Alien Code',
                'meta_desc_en' => 'Professional website design and development in Jordan. Alien Code builds bilingual, SEO-optimized websites for businesses in Amman and across the Middle East.',
                'meta_desc_ar' => 'تصميم وتطوير مواقع إلكترونية احترافية في الأردن. يبني Alien Code مواقع ثنائية اللغة محسّنة لمحركات البحث للشركات في عمّان وعبر الشرق الأوسط.',
                'is_active'    => true,
                'published_at' => Carbon::now()->subDays(38),
                'sort_order'   => 4,
            ],

            // ─────────────────────────────────────────────────────────────
            // LP5 — ERP Software Jordan
            // ─────────────────────────────────────────────────────────────
            [
                'slug'         => 'erp-software-development-jordan',
                'title_en'     => 'ERP Software Development in Jordan | Custom Business Systems',
                'title_ar'     => 'تطوير برامج ERP في الأردن | أنظمة أعمال مخصصة',
                'excerpt_en'   => 'Alien Code builds custom ERP and business management systems for Jordanian companies — manufacturing, distribution, retail, and service businesses. Replace spreadsheets with software built for your exact workflow.',
                'excerpt_ar'   => 'يبني Alien Code أنظمة ERP وإدارة أعمال مخصصة للشركات الأردنية — تصنيع وتوزيع وتجزئة وخدمات. استبدل جداول البيانات ببرمجيات مبنية لسير عملك بالضبط.',
                'body_en'      => $this->lpErpJordanEn(),
                'body_ar'      => $this->lpErpJordanAr(),
                'category_en'  => 'ERP',
                'category_ar'  => 'أنظمة ERP',
                'tags'         => ['ERP', 'Jordan', 'Business Software', 'Manufacturing', 'Custom'],
                'author'       => 'Alien Code',
                'meta_title_en'=> 'ERP Software Development Jordan | Custom Systems — Alien Code',
                'meta_title_ar'=> 'تطوير برامج ERP في الأردن | أنظمة مخصصة — Alien Code',
                'meta_desc_en' => 'Alien Code builds custom ERP systems for Jordanian businesses. Manufacturing, inventory, HR, accounting, and CRM — all in one system built for your specific workflow.',
                'meta_desc_ar' => 'يبني Alien Code أنظمة ERP مخصصة للشركات الأردنية. تصنيع ومخزون وموارد بشرية ومحاسبة وCRM — كلها في نظام واحد مبني لسير عملك المحدد.',
                'is_active'    => true,
                'published_at' => Carbon::now()->subDays(35),
                'sort_order'   => 5,
            ],

        ];
    }

    // ── Landing page body methods ────────────────────────────────────────

    private function lpSoftwareDevJordanEn(): string
    {
        return <<<HTML
<h2>Building Software for Jordan's Business Landscape</h2>
<p>Alien Code is a full-service software development company headquartered in Amman, Jordan. We design and build custom software solutions that help Jordanian businesses operate more efficiently, serve their customers better, and compete in a digital-first market.</p>
<p>Our team combines technical expertise with a deep understanding of the Jordanian business environment — from Arabic-first user experience and local payment gateway requirements to compliance with Jordanian regulatory frameworks.</p>

<h2>Our Core Services</h2>
<ul>
  <li><strong>Custom Web Applications:</strong> Laravel-based web platforms, portals, and SaaS products tailored to your business processes</li>
  <li><strong>Mobile App Development:</strong> iOS and Android apps built with React Native and Flutter for consumer and enterprise use</li>
  <li><strong>ERP &amp; Business Management Systems:</strong> Custom enterprise resource planning for manufacturing, distribution, and service companies</li>
  <li><strong>E-commerce Development:</strong> Arabic-first online stores with local payment gateway integration</li>
  <li><strong>AI &amp; Automation:</strong> Machine learning integration, NLP for Arabic content, and intelligent workflow automation</li>
  <li><strong>UI/UX Design:</strong> User-centered design for web and mobile with bilingual support</li>
</ul>

<h2>Why Jordanian Businesses Choose Alien Code</h2>

<h3>Local Market Expertise</h3>
<p>We understand what Jordanian businesses need: Arabic RTL layouts, integration with local payment systems (eFAWATEERcom, Hyperpay), compliance with Jordanian data and financial regulations, and a support team you can reach during Amman business hours.</p>

<h3>Technical Excellence</h3>
<p>Our engineers work with the same technology stack used by global software companies — Laravel, Vue.js, React, Flutter, Python, and cloud infrastructure on AWS and DigitalOcean. The difference is that we apply this expertise specifically to the challenges of the Jordanian and MENA market.</p>

<h3>Partnership, Not a Transaction</h3>
<p>We do not disappear after launch. Our post-launch support, iterative development, and long-term partnership model means your software grows with your business rather than becoming a technical debt problem in 18 months.</p>

<h2>Industries We Serve in Jordan</h2>
<p>Manufacturing and industrial operations, retail and e-commerce, healthcare and medical services, real estate and property management, education and training, logistics and supply chain, financial services and fintech, government and public sector digital services.</p>

<h2>Our Development Process</h2>
<ol>
  <li><strong>Discovery:</strong> We study your business, map your requirements, and design the right technical approach</li>
  <li><strong>Design:</strong> UI/UX design with your brand identity, bilingual layout, and user testing</li>
  <li><strong>Development:</strong> Agile sprints with weekly demos, continuous integration, and transparent progress tracking</li>
  <li><strong>Testing:</strong> Automated testing, security audit, performance benchmarking, and user acceptance testing</li>
  <li><strong>Launch:</strong> Coordinated deployment with zero-downtime strategy and rollback capability</li>
  <li><strong>Support:</strong> Ongoing maintenance, monitoring, and feature development</li>
</ol>

<h2>Frequently Asked Questions</h2>

<h3>Where is Alien Code located?</h3>
<p>Alien Code is headquartered in Amman, Jordan. We primarily serve businesses in Jordan and the wider Middle East region.</p>

<h3>Do you work with small businesses or only large enterprises?</h3>
<p>We work with businesses of all sizes — from startups launching their first product to established enterprises modernizing legacy systems. Our engagement model adapts to your budget and stage.</p>

<h3>How long does a typical software project take?</h3>
<p>Timelines vary significantly by scope. A corporate website takes 4–8 weeks; a custom mobile app typically takes 3–6 months; a complex ERP system may take 6–18 months for full deployment. We provide detailed timelines after a proper requirements analysis.</p>

<h3>Do you offer post-launch support?</h3>
<p>Yes. We offer ongoing maintenance, hosting management, security updates, and iterative feature development. Our clients typically work with us on a retainer or project basis after the initial launch.</p>

<h2>Start Your Project</h2>
<p>Contact the Alien Code team in Amman for a free, no-obligation consultation. We will review your requirements, ask the right questions, and provide a clear proposal — usually within 3–5 business days.</p>
HTML;
    }

    private function lpSoftwareDevJordanAr(): string
    {
        return <<<HTML
<h2>بناء برمجيات للمشهد التجاري الأردني</h2>
<p>Alien Code شركة تطوير برمجيات متكاملة الخدمات مقرها عمّان، الأردن. نصمم وننشئ حلولاً برمجية مخصصة تساعد الشركات الأردنية على العمل بكفاءة أكبر وخدمة عملائها بشكل أفضل والمنافسة في سوق رقمي المحور.</p>
<p>يجمع فريقنا بين الخبرة التقنية وفهم عميق للبيئة التجارية الأردنية — من تجربة المستخدم العربية ومتطلبات بوابات الدفع المحلية إلى الامتثال للأطر التنظيمية الأردنية.</p>

<h2>خدماتنا الأساسية</h2>
<ul>
  <li><strong>تطبيقات الويب المخصصة:</strong> منصات ويب قائمة على Laravel وبوابات ومنتجات SaaS مصممة لعملياتك</li>
  <li><strong>تطوير تطبيقات الجوال:</strong> تطبيقات iOS وAndroid بـ React Native وFlutter</li>
  <li><strong>أنظمة ERP وإدارة الأعمال:</strong> تخطيط موارد مؤسسية مخصص</li>
  <li><strong>تطوير التجارة الإلكترونية:</strong> متاجر إلكترونية عربية أولاً مع تكامل بوابات الدفع المحلية</li>
  <li><strong>الذكاء الاصطناعي والأتمتة:</strong> تكامل تعلم الآلة ومعالجة اللغة الطبيعية للمحتوى العربي</li>
</ul>

<h2>الأسئلة الشائعة</h2>

<h3>أين يقع Alien Code؟</h3>
<p>Alien Code مقره في عمّان، الأردن. نخدم بشكل أساسي الشركات في الأردن ومنطقة الشرق الأوسط الأوسع.</p>

<h3>هل تعملون مع الشركات الصغيرة أم فقط المؤسسات الكبيرة؟</h3>
<p>نعمل مع شركات من جميع الأحجام — من الشركات الناشئة التي تطلق أول منتج لها إلى المؤسسات الراسخة التي تحدّث أنظمتها القديمة.</p>

<h2>ابدأ مشروعك</h2>
<p>تواصل مع فريق Alien Code في عمّان للحصول على استشارة مجانية غير ملزمة. سنراجع متطلباتك ونطرح الأسئلة المناسبة ونقدم عرضاً واضحاً — عادةً خلال 3–5 أيام عمل.</p>
HTML;
    }

    private function lpSoftwareCompanyArEn(): string
    {
        return <<<HTML
<h2>A Software Company That Understands Jordan</h2>
<p>There are many software companies you could work with. What sets Alien Code apart is that we operate in the same market you do. We understand the Arabic language requirements, the local payment systems, the business culture, and the regulatory environment that shapes how software needs to work for a Jordanian business.</p>

<h2>What We Build</h2>
<p>Custom websites and web applications, mobile apps for iOS and Android, ERP and inventory management systems, e-commerce platforms with Arabic UX, business automation tools, and AI integrations that solve real operational problems.</p>

<h2>Who We Work With</h2>
<p>Small and medium businesses in Amman and across Jordan who have outgrown their current tools. Enterprises modernizing legacy systems. Startups building their first digital product. We adapt our engagement model to your size, stage, and budget.</p>

<h2>How We Work</h2>
<p>We start with a detailed discovery session to understand your business and requirements. We then design and develop in agile sprints with weekly demos and transparent progress reporting. Every project includes testing, security review, and a structured launch process.</p>

<h2>Get a Free Consultation</h2>
<p>Tell us what you need to build and we will tell you honestly how to approach it, how long it will take, and what it will cost. No hidden fees, no vague proposals. <a href="/contact">Contact us today</a>.</p>
HTML;
    }

    private function lpSoftwareCompanyArAr(): string
    {
        return <<<HTML
<h2>شركة برمجة تفهم الأردن</h2>
<p>هناك الكثير من شركات البرمجة التي يمكنك العمل معها. ما يميز Alien Code هو أننا نعمل في نفس السوق الذي تعمل فيه. نفهم متطلبات اللغة العربية وأنظمة الدفع المحلية وثقافة الأعمال والبيئة التنظيمية التي تشكل طريقة عمل البرمجيات للشركة الأردنية.</p>

<h2>ما نبنيه</h2>
<p>مواقع وتطبيقات ويب مخصصة، وتطبيقات جوال لـ iOS وAndroid، وأنظمة ERP وإدارة المخزون، ومنصات تجارة إلكترونية بواجهة عربية، وأدوات أتمتة الأعمال، وتكاملات ذكاء اصطناعي تحل مشاكل تشغيلية حقيقية.</p>

<h2>مع من نعمل</h2>
<p>الشركات الصغيرة والمتوسطة في عمّان وعبر الأردن التي تجاوزت أدواتها الحالية. والمؤسسات التي تحدّث أنظمتها القديمة. والشركات الناشئة التي تبني أول منتج رقمي لها.</p>

<h2>احصل على استشارة مجانية</h2>
<p>أخبرنا بما تحتاج إلى بنائه وسنخبرك بصدق كيفية المضي قدماً ومدة ذلك وتكلفته. <a href="/contact">تواصل معنا اليوم</a>.</p>
HTML;
    }

    private function lpWebDevJordanEn(): string
    {
        return <<<HTML
<h2>Professional Web Development for Jordan's Digital Market</h2>
<p>A professionally built website is the foundation of your digital presence. Whether you need a corporate site, a customer portal, an e-commerce platform, or a complex web application, Alien Code delivers web development that is technically excellent, visually compelling, and optimized for the Jordanian and Arabic-speaking market.</p>

<h2>What We Build</h2>
<h3>Corporate Websites</h3>
<p>Multi-language corporate sites with bilingual Arabic/English content management, SEO optimization, and brand-aligned design. Built on Laravel for performance and long-term maintainability.</p>

<h3>Web Applications</h3>
<p>Custom platforms with user authentication, database-driven content, API integrations, and real-time features. Designed for businesses that need more than a brochure website.</p>

<h3>E-commerce Platforms</h3>
<p>Arabic-first online stores with local payment gateways, inventory management, order tracking, and mobile-optimized checkout. Built to convert Jordanian shoppers.</p>

<h3>Landing Pages &amp; Marketing Sites</h3>
<p>High-converting landing pages with fast load times, clear CTAs, and structured data for search engine visibility. Ideal for product launches and lead generation campaigns.</p>

<h2>Our Web Development Technology Stack</h2>
<ul>
  <li><strong>Backend:</strong> Laravel (PHP) — the leading choice for reliable, secure web applications</li>
  <li><strong>Frontend:</strong> Vue.js, React, and TypeScript — for dynamic, high-performance interfaces</li>
  <li><strong>SEO:</strong> Server-side rendering, semantic HTML, structured data, and Core Web Vitals optimization</li>
  <li><strong>Arabic support:</strong> Full RTL layout, Arabic typography, locale-aware formatting</li>
</ul>

<h2>Why Businesses in Jordan Choose Us for Web Development</h2>
<p>We understand the unique requirements of web development for the Jordanian market: Arabic-first design, local hosting options, Jordan-specific SEO, and the integration requirements of Jordanian payment, logistics, and government systems.</p>

<h2>Request a Web Development Quote</h2>
<p>Tell us about your project and we will provide a free assessment, technology recommendation, and development proposal within 3 business days. <a href="/contact">Get in touch</a>.</p>
HTML;
    }

    private function lpWebDevJordanAr(): string
    {
        return <<<HTML
<h2>تطوير ويب احترافي للسوق الرقمي الأردني</h2>
<p>الموقع الإلكتروني المبني باحترافية هو أساس وجودك الرقمي. سواء كنت تحتاج إلى موقع مؤسسي أو بوابة عملاء أو منصة تجارة إلكترونية أو تطبيق ويب معقد، يقدم Alien Code تطوير ويب متميزاً تقنياً وجذاباً بصرياً ومحسّناً للسوق الأردني والناطق بالعربية.</p>

<h2>ما نبنيه</h2>
<h3>المواقع المؤسسية</h3>
<p>مواقع مؤسسية متعددة اللغات بإدارة محتوى عربي/إنجليزي ثنائي اللغة وتحسين محركات البحث وتصميم يعكس هوية علامتك التجارية.</p>

<h3>تطبيقات الويب</h3>
<p>منصات مخصصة بمصادقة مستخدمين ومحتوى مدفوع بقاعدة بيانات وتكاملات API وميزات في الوقت الفعلي.</p>

<h3>منصات التجارة الإلكترونية</h3>
<p>متاجر إلكترونية عربية أولاً مع بوابات دفع محلية وإدارة مخزون وتتبع طلبات وسداد محسّن للجوال.</p>

<h2>اطلب عرض سعر لتطوير الويب</h2>
<p>أخبرنا عن مشروعك وسنقدم تقييماً مجانياً وتوصية تقنية ومقترح تطوير خلال 3 أيام عمل. <a href="/contact">تواصل معنا</a>.</p>
HTML;
    }

    private function lpWebDesignArEn(): string
    {
        return <<<HTML
<h2>Website Design Built for the Arabic and English User</h2>
<p>Designing a website for the Jordanian market is not simply a matter of translating an English website into Arabic. It requires understanding how Arabic-speaking users read, navigate, and make decisions — and building a user experience that feels native in both languages.</p>
<p>Alien Code designs and develops bilingual websites that perform equally well for Arabic and English users, with proper RTL layout, Arabic typography, and culturally appropriate visual design.</p>

<h2>Our Web Design Approach</h2>
<h3>User Research &amp; Information Architecture</h3>
<p>We map your users, their goals, and the content hierarchy before designing anything. Good design solves a problem — it does not just make something look attractive.</p>

<h3>Bilingual UI Design</h3>
<p>We design for both LTR (English) and RTL (Arabic) simultaneously, not as an afterthought. This means layout grids, typography, iconography, and interaction patterns are tested and refined for both directions.</p>

<h3>Responsive &amp; Mobile-First</h3>
<p>Over 70% of Jordanian internet users access websites on mobile. Every website we design is mobile-first, tested across devices and screen sizes.</p>

<h3>Performance-Optimized Design</h3>
<p>Design decisions affect performance. We choose image formats, animation approaches, and component patterns with Core Web Vitals and page speed in mind from the first design iteration.</p>

<h2>Design + Development in One Team</h2>
<p>Unlike agencies that hand designs to a separate development team, our designers and developers work together from day one. The result is a website that matches the design pixel-for-pixel and performs as well as it looks.</p>

<h2>Request a Design Consultation</h2>
<p>Share your current website (if you have one) or describe what you want to build and we will give you honest feedback and a design proposal. <a href="/contact">Contact us</a>.</p>
HTML;
    }

    private function lpWebDesignArAr(): string
    {
        return <<<HTML
<h2>تصميم مواقع مبني للمستخدم العربي والإنجليزي</h2>
<p>تصميم موقع إلكتروني للسوق الأردني ليس مجرد ترجمة موقع إنجليزي إلى العربية. يتطلب فهم كيفية قراءة المستخدمين الناطقين بالعربية والتنقل واتخاذ القرارات — وبناء تجربة مستخدم تبدو طبيعية في كلتا اللغتين.</p>
<p>يصمم Alien Code ويطور مواقع ثنائية اللغة تؤدي أداءً متساوياً للمستخدمين العرب والإنجليز، مع تخطيط RTL مناسب وطباعة عربية وتصميم بصري مناسب ثقافياً.</p>

<h2>نهجنا في تصميم المواقع</h2>
<h3>تصميم واجهة مستخدم ثنائية اللغة</h3>
<p>نصمم لـ LTR (الإنجليزية) وRTL (العربية) في آن واحد، وليس كفكرة لاحقة. هذا يعني اختبار شبكات التخطيط والطباعة وأيقونات التفاعل وأنماطه وتحسينها في كلا الاتجاهين.</p>

<h3>متجاوب وأولوية للجوال</h3>
<p>أكثر من 70% من مستخدمي الإنترنت الأردنيين يصلون إلى المواقع من الجوال. كل موقع نصممه يضع الجوال في المقدمة.</p>

<h2>اطلب استشارة تصميم</h2>
<p>شارك موقعك الحالي (إن وُجد) أو صف ما تريد بناءه وسنقدم لك تعليقات صادقة ومقترح تصميم. <a href="/contact">تواصل معنا</a>.</p>
HTML;
    }

    private function lpErpJordanEn(): string
    {
        return <<<HTML
<h2>ERP Software Designed for Jordanian Business Realities</h2>
<p>Running a business in Jordan with spreadsheets, disconnected tools, and manual processes has a ceiling. Beyond a certain scale, the cost of inefficiency — in errors, delays, and the management time spent reconciling data across systems — exceeds the cost of building a proper integrated system.</p>
<p>Alien Code builds custom ERP systems for Jordanian businesses that are tired of adapting their operations to fit generic software.</p>

<h2>What a Custom ERP from Alien Code Includes</h2>

<h3>Operations Management</h3>
<ul>
  <li>Inventory and warehouse management with real-time stock tracking</li>
  <li>Purchase order management and supplier portal</li>
  <li>Production planning and job order management (for manufacturing)</li>
  <li>Quality control and inspection workflows</li>
</ul>

<h3>Sales and Customer Management</h3>
<ul>
  <li>Customer database and relationship management</li>
  <li>Quotation and proposal management</li>
  <li>Order processing and delivery tracking</li>
  <li>Invoicing and accounts receivable</li>
</ul>

<h3>Financial Management</h3>
<ul>
  <li>Arabic-language chart of accounts</li>
  <li>Accounts payable and receivable</li>
  <li>Cost accounting and profit margin reporting</li>
  <li>VAT and tax compliance for Jordanian regulations</li>
</ul>

<h3>HR and Payroll</h3>
<ul>
  <li>Employee records and attendance management</li>
  <li>Leave and overtime management</li>
  <li>Payroll calculation with Jordanian Social Security deductions</li>
  <li>End-of-service calculation</li>
</ul>

<h2>Why Custom ERP Instead of Odoo or SAP?</h2>
<p>Packaged ERP systems are designed for thousands of different businesses. Their flexibility is also their complexity — and their customization costs can quickly rival the cost of building something that is right for you from the start. A custom ERP has no licensing fees, is built around your actual workflow, and evolves with your business without requiring expensive consultant engagements for every change.</p>

<h2>Who We Build ERP Systems For</h2>
<p>Manufacturing companies in Amman and across Jordan, trading and distribution businesses, retail chains, service companies with field operations, healthcare providers, and any organization that has outgrown its current management system.</p>

<h2>Start With a Free Process Analysis</h2>
<p>Before we propose a solution, we map your current processes. This free session typically takes 2–3 hours and gives both parties a clear picture of what needs to be built and how long it will take. <a href="/contact">Schedule your session</a>.</p>
HTML;
    }

    private function lpErpJordanAr(): string
    {
        return <<<HTML
<h2>برامج ERP مصممة لواقع الأعمال الأردني</h2>
<p>إدارة شركة في الأردن بجداول بيانات وأدوات منفصلة وعمليات يدوية لها سقف محدد. ما وراء حجم معين، تتجاوز تكلفة عدم الكفاءة — في الأخطاء والتأخير ووقت الإدارة المُنفق على التوفيق بين البيانات عبر الأنظمة — تكلفة بناء نظام متكامل مناسب.</p>
<p>يبني Alien Code أنظمة ERP مخصصة للشركات الأردنية التي مَلّت من تكييف عملياتها لتناسب البرامج الجاهزة.</p>

<h2>ما يتضمنه نظام ERP المخصص من Alien Code</h2>
<ul>
  <li>إدارة المخزون والمستودعات مع تتبع المخزون في الوقت الفعلي</li>
  <li>إدارة طلبات الشراء وبوابة الموردين</li>
  <li>تخطيط الإنتاج وإدارة أوامر العمل (للتصنيع)</li>
  <li>إدارة العملاء وإصدار الفواتير</li>
  <li>الرواتب مع احتساب الضمان الاجتماعي الأردني</li>
</ul>

<h2>ابدأ بتحليل عمليات مجاني</h2>
<p>قبل أن نقترح حلاً، نرسم خريطة عملياتك الحالية. تستغرق هذه الجلسة المجانية عادةً 2–3 ساعات وتعطي كلا الطرفين صورة واضحة عما يحتاج إلى بناء ومدة ذلك. <a href="/contact">جدول جلستك</a>.</p>
HTML;
    }
}
