<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ---- Admin user (Filament panel) ----
        User::updateOrCreate(
            ['email' => 'admin@alzain.test'],
            ['name' => 'Al Zain Admin', 'password' => bcrypt('password')]
        );

        // ---- Branches ----
        $branches = [
            [
                'name' => ['en' => 'Al Zain — Qurum', 'ar' => 'الزين — القرم'],
                'city' => ['en' => 'Muscat', 'ar' => 'مسقط'],
                'address' => ['en' => 'Way 3045, Qurum, near CCC', 'ar' => 'طريق 3045، القرم، بالقرب من مجمع سيتي سنتر'],
                'phone' => '+968 2456 7890',
                'whatsapp' => '+968 9123 4567',
                'hours' => [['en' => 'Sat–Thu: 9:00 – 21:00', 'ar' => 'السبت–الخميس: 9:00 – 21:00'], ['en' => 'Fri: 2:00 – 21:00', 'ar' => 'الجمعة: 2:00 – 21:00']],
                'sort' => 1,
            ],
            [
                'name' => ['en' => 'Al Zain — Al Mouj', 'ar' => 'الزين — الموج'],
                'city' => ['en' => 'Muscat', 'ar' => 'مسقط'],
                'address' => ['en' => 'The Walk, Al Mouj Marina', 'ar' => 'ذا ووك، مرسى الموج'],
                'phone' => '+968 2400 1122',
                'whatsapp' => '+968 9200 3344',
                'hours' => [['en' => 'Daily: 10:00 – 22:00', 'ar' => 'يوميًا: 10:00 – 22:00']],
                'sort' => 2,
            ],
        ];
        foreach ($branches as $b) {
            Branch::create($b);
        }

        // ---- Staff ----
        $staffNames = [
            [['en' => 'Layla Al Habsi', 'ar' => 'ليلى الحبسية'], ['en' => 'Senior Esthetician', 'ar' => 'أخصائية بشرة أولى']],
            [['en' => 'Maryam Said', 'ar' => 'مريم سعيد'], ['en' => 'Hair Stylist', 'ar' => 'مصففة شعر']],
            [['en' => 'Noura Al Balushi', 'ar' => 'نورة البلوشية'], ['en' => 'Nail Technician', 'ar' => 'أخصائية أظافر']],
            [['en' => 'Aisha Rahman', 'ar' => 'عائشة رحمن'], ['en' => 'Facial Specialist', 'ar' => 'أخصائية جلسات وجه']],
        ];
        $staff = collect($staffNames)->map(fn ($s, $i) => Staff::create([
            'name' => $s[0],
            'title' => $s[1],
            'bio' => ['en' => 'Part of the Al Zain team, dedicated to gentle, expert care.', 'ar' => 'جزء من فريق الزين، ملتزمة بعناية لطيفة واحترافية.'],
            'branch_id' => $i < 2 ? 1 : 2,
            'sort' => $i + 1,
        ]));

        // ---- Service categories + services ----
        $serviceData = [
            [
                'cat' => ['en' => 'Facials', 'ar' => 'جلسات الوجه'],
                'desc' => ['en' => 'Deep-cleansing and glow treatments for every skin type.', 'ar' => 'جلسات تنظيف عميق ونضارة لكل أنواع البشرة.'],
                'items' => [
                    [['en' => 'Signature Glow Facial', 'ar' => 'جلسة النضارة المميزة'], 25.000, 60, ['en' => 'A full cleanse, exfoliation, mask and massage to leave skin luminous.', 'ar' => 'تنظيف كامل وتقشير وقناع وتدليك لتترك البشرة مشرقة.'], true],
                    [['en' => 'Hydrating Facial', 'ar' => 'جلسة ترطيب'], 20.000, 45, ['en' => 'Moisture-boosting treatment for dry and tired skin.', 'ar' => 'جلسة تعزيز الترطيب للبشرة الجافة والمتعبة.'], false],
                    [['en' => 'Anti-Acne Deep Clean', 'ar' => 'تنظيف عميق لعلاج حب الشباب'], 28.000, 70, ['en' => 'Targeted extraction and calming therapy for breakout-prone skin.', 'ar' => 'استخراج موجّه وعلاج مهدئ للبشرة المعرضة للحبوب.'], false],
                ],
            ],
            [
                'cat' => ['en' => 'Hair', 'ar' => 'الشعر'],
                'desc' => ['en' => 'Cuts, colour and care by our stylists.', 'ar' => 'قص وصبغ وعناية على يد مصففاتنا.'],
                'items' => [
                    [['en' => 'Cut & Blow-Dry', 'ar' => 'قص وتجفيف'], 15.000, 60, ['en' => 'A precision cut finished with a smooth blow-dry.', 'ar' => 'قصة دقيقة مع تجفيف ناعم.'], true],
                    [['en' => 'Full Colour', 'ar' => 'صبغة كاملة'], 35.000, 120, ['en' => 'Single-process colour, gloss and style.', 'ar' => 'صبغة كاملة مع لمعان وتصفيف.'], false],
                    [['en' => 'Keratin Treatment', 'ar' => 'علاج كيراتين'], 45.000, 150, ['en' => 'Smoothing treatment for frizz-free, manageable hair.', 'ar' => 'علاج تنعيم لشعر خالٍ من التطاير وسهل التصفيف.'], false],
                ],
            ],
            [
                'cat' => ['en' => 'Nails', 'ar' => 'الأظافر'],
                'desc' => ['en' => 'Manicures and pedicures with lasting finishes.', 'ar' => 'مانيكير وباديكير بلمسات تدوم.'],
                'items' => [
                    [['en' => 'Classic Manicure', 'ar' => 'مانيكير كلاسيكي'], 8.000, 40, ['en' => 'Shape, cuticle care and polish.', 'ar' => 'تشكيل وعناية بالجلد ولون.'], false],
                    [['en' => 'Gel Manicure', 'ar' => 'مانيكير جل'], 12.000, 55, ['en' => 'Long-lasting gel colour with a glossy finish.', 'ar' => 'لون جل يدوم طويلاً بلمسة لامعة.'], true],
                    [['en' => 'Spa Pedicure', 'ar' => 'باديكير سبا'], 14.000, 60, ['en' => 'Soak, scrub, massage and polish.', 'ar' => 'نقع وتقشير وتدليك ولون.'], false],
                ],
            ],
            [
                'cat' => ['en' => 'Brows & Lashes', 'ar' => 'الحواجب والرموش'],
                'desc' => ['en' => 'Shaping and tinting to frame your eyes.', 'ar' => 'تشكيل وصبغ لإبراز عينيك.'],
                'items' => [
                    [['en' => 'Brow Shaping & Tint', 'ar' => 'تشكيل وصبغ الحواجب'], 7.000, 30, ['en' => 'Threading or waxing plus a tailored tint.', 'ar' => 'خيط أو شمع مع صبغة مناسبة.'], false],
                    [['en' => 'Lash Lift', 'ar' => 'رفع الرموش'], 18.000, 60, ['en' => 'A natural curl that lasts for weeks.', 'ar' => 'تجعيد طبيعي يدوم لأسابيع.'], true],
                ],
            ],
        ];

        foreach ($serviceData as $si => $group) {
            $category = ServiceCategory::create([
                'name' => $group['cat'],
                'slug' => Str::slug($group['cat']['en']),
                'description' => $group['desc'],
                'sort' => $si + 1,
            ]);

            foreach ($group['items'] as $idx => $item) {
                $service = Service::create([
                    'service_category_id' => $category->id,
                    'name' => $item[0],
                    'slug' => Str::slug($item[0]['en']),
                    'price' => $item[1],
                    'duration_minutes' => $item[2],
                    'description' => $item[3],
                    'is_featured' => $item[4] ?? false,
                    'sort' => $idx + 1,
                ]);
                $service->staff()->attach($staff->random(min(2, $staff->count()))->pluck('id'));
            }
        }

        // ---- Product categories + products ----
        $productData = [
            [
                'cat' => ['en' => 'Skincare', 'ar' => 'العناية بالبشرة'], 'slug' => 'skincare',
                'desc' => ['en' => 'Cleansers, serums and moisturisers we trust.', 'ar' => 'غسولات وسيرومات ومرطبات نثق بها.'],
                'items' => [
                    [['en' => 'Gentle Gel Cleanser', 'ar' => 'غسول جل لطيف'], 'Al Zain', 9.500, null, 40],
                    [['en' => 'Vitamin C Brightening Serum', 'ar' => 'سيروم فيتامين سي للإشراق'], 'Al Zain', 22.000, 18.000, 25],
                    [['en' => 'Hyaluronic Hydra Moisturiser', 'ar' => 'مرطب الهيالورونيك'], 'Al Zain', 16.000, null, 30],
                    [['en' => 'SPF 50 Daily Fluid', 'ar' => 'واقٍ يومي SPF 50'], 'Solora', 14.000, null, 50],
                    [['en' => 'Overnight Repair Mask', 'ar' => 'قناع الإصلاح الليلي'], 'Solora', 19.000, null, 15],
                ],
            ],
            [
                'cat' => ['en' => 'Facial Tools', 'ar' => 'أدوات العناية بالوجه'], 'slug' => 'facial-tools',
                'desc' => ['en' => 'At-home tools to extend your treatment.', 'ar' => 'أدوات منزلية لإطالة أثر جلستك.'],
                'items' => [
                    [['en' => 'Rose Quartz Gua Sha', 'ar' => 'حجر جوا شا من الكوارتز الوردي'], 'Al Zain', 7.000, null, 60],
                    [['en' => 'Facial Roller', 'ar' => 'رولر للوجه'], 'Al Zain', 6.500, 5.000, 45],
                    [['en' => 'Silicone Cleansing Brush', 'ar' => 'فرشاة تنظيف سيليكون'], 'Solora', 11.000, null, 35],
                ],
            ],
            [
                'cat' => ['en' => 'Fashion', 'ar' => 'الأزياء'], 'slug' => 'fashion',
                'desc' => ['en' => 'Abayas, scarves and accessories to complete the look.', 'ar' => 'عبايات وأوشحة وإكسسوارات تكمل إطلالتك.'],
                'items' => [
                    [['en' => 'Everyday Crepe Abaya', 'ar' => 'عباية كريب يومية'], 'Al Zain Atelier', 38.000, null, 20],
                    [['en' => 'Silk Blend Scarf', 'ar' => 'وشاح حرير ممزوج'], 'Al Zain Atelier', 12.000, 9.000, 40],
                    [['en' => 'Pearl Hair Pins (Set of 6)', 'ar' => 'دبابيس شعر لؤلؤية (طقم 6)'], 'Al Zain Atelier', 5.500, null, 55],
                    [['en' => 'Structured Tote Bag', 'ar' => 'حقيبة يد بتصميم محكم'], 'Al Zain Atelier', 29.000, null, 12],
                ],
            ],
        ];

        foreach ($productData as $pi => $group) {
            $category = ProductCategory::create([
                'name' => $group['cat'],
                'slug' => $group['slug'],
                'description' => $group['desc'],
                'sort' => $pi + 1,
            ]);

            foreach ($group['items'] as $idx => $item) {
                Product::create([
                    'product_category_id' => $category->id,
                    'name' => $item[0],
                    'slug' => Str::slug($item[0]['en']),
                    'brand' => $item[1],
                    'sku' => 'AZ-'.strtoupper(Str::random(6)),
                    'price' => $item[2],
                    'sale_price' => $item[3],
                    'stock' => $item[4],
                    'short_description' => [
                        'en' => 'A shop favourite from the Al Zain treatment rooms.',
                        'ar' => 'من المنتجات المفضلة في غرف جلسات الزين.',
                    ],
                    'description' => [
                        'en' => "Formulated and tested by our specialists. Suitable for daily use as part of your Al Zain routine.",
                        'ar' => "مُركّب ومُختبَر من أخصائياتنا. مناسب للاستخدام اليومي ضمن روتين الزين الخاص بك.",
                    ],
                    'is_featured' => $idx < 2,
                    'sort' => $idx + 1,
                ]);
            }
        }
    }
}
