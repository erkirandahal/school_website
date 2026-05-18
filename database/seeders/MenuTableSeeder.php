<?php

namespace Database\Seeders;

use App\Enums\Page;
use App\Enums\PostCategory;
use App\Models\Frontend\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    public function run(): void
    {
        Menu::truncate();

        $menus = [
            [
                'label' => 'Home',
                'label_nepali' => 'गृहपृष्ठ',
                'url' => '/',
                'position' => 0,
            ],
            [
                'label' => 'About Us',
                'label_nepali' => 'हाम्रो बारेमा',
                'url' => '/' . Page::ABOUT->slug(),
                'position' => 1,
                'children' => [
                    [
                        'label' => 'Introduction',
                        'label_nepali' => 'परिचय',
                        'url' => '/' . Page::INTRODUCTION->slug(),
                        'position' => 9,
                    ],
                    [
                        'label' => 'Mission, Vision, Goals & Objectives',
                        'label_nepali' => 'मिशन, भिजन, लक्ष्य र उद्देश्य',
                        'url' => '/' . Page::MISSION_VISION_GOAL_AND_OBJECTIVES->slug(),
                        'position' => 10,
                    ],
                    [
                        'label' => 'Student Clubs',
                        'label_nepali' => 'विद्यार्थी क्लबहरू',
                        'url' => '/' . Page::STUDENT_CLUBS->slug(),
                        'position' => 11,
                    ],
                ]
            ],
            [
                'label' => 'Members',
                'label_nepali' => 'सदस्यहरू',
                'url' => null,
                'position' => 2,
                'children' => [
                    [
                        'label' => 'Faculties',
                        'label_nepali' => 'शिक्षकहरू',
                        'url' => '/faculties',
                        'position' => 13,
                    ],
                    [
                        'label' => 'School Management Committee (SMC)',
                        'label_nepali' => 'विद्यालय व्यवस्थापन समिति (SMC)',
                        'url' => '/' . Page::SMC->slug(),
                        'position' => 14,
                    ],
                    [
                        'label' => 'Parent Teacher Association (PTA)',
                        'label_nepali' => 'अभिभावक शिक्षक संघ (PTA)',
                        'url' => '/' . Page::PTA->slug(),
                        'position' => 15,
                    ],
                ]
            ],
            [
                'label' => 'Programs',
                'label_nepali' => 'कार्यक्रमहरू',
                'url' => '/programs',
                'position' => 3,
                'is_active' => false,
            ],
            [
                'label' => 'Facilities',
                'label_nepali' => 'सुविधाहरू',
                'url' => '/facilities',
                'position' => 4,
            ],
            [
                'label' => 'News & Events',
                'label_nepali' => 'समाचार तथा कार्यक्रम',
                'url' => '/' . PostCategory::NEWS_AND_EVENTS->slug(),
                'position' => 5,
            ],
            [
                'label' => 'Resources',
                'label_nepali' => 'स्रोतहरू',
                'url' => null,
                'position' => 6,
                'children' => [
                    [
                        'label' => 'Notices',
                        'label_nepali' => 'सूचनाहरू',
                        'url' => '/resources/' . PostCategory::NOTICE->slug(),
                        'position' => 16,
                    ],
                    [
                        'label' => 'Annual Calendar',
                        'label_nepali' => 'वार्षिक क्यालेन्डर',
                        'url' => '/resources/' . PostCategory::ANNUAL_CALENDAR->slug(),
                        'position' => 17,
                    ],
                    [
                        'label' => 'Career',
                        'label_nepali' => 'करियर',
                        'url' => '/resources/' . PostCategory::CAREER->slug(),
                        'position' => 18,
                    ],
                    [
                        'label' => 'SMC Decisions',
                        'label_nepali' => 'SMC निर्णयहरू',
                        'url' => '/resources/' . PostCategory::SMC_DECISION->slug(),
                        'position' => 19,
                    ],
                    [
                        'label' => 'Publications',
                        'label_nepali' => 'प्रकाशनहरू',
                        'url' => '/publications',
                        'position' => 20,
                    ],
                ]
            ],
            [
                'label' => 'Gallery',
                'label_nepali' => 'ग्यालरी',
                'url' => null,
                'position' => 7,
                'children' => [
                    [
                        'label' => 'Photo Gallery',
                        'label_nepali' => 'फोटो ग्यालरी',
                        'url' => '/photo-gallery',
                        'position' => 21,
                    ],
                    [
                        'label' => 'Video Gallery',
                        'label_nepali' => 'भिडियो ग्यालरी',
                        'url' => '/video-gallery',
                        'position' => 22,
                    ],
                ]
            ],
            [
                'label' => 'Contact Us',
                'label_nepali' => 'सम्पर्क गर्नुहोस्',
                'url' => '/' . Page::CONTACT_US->slug(),
                'position' => 8,
            ],
        ];

        foreach ($menus as $menu) {
            $this->createMenu($menu);
        }
    }

    private function createMenu(array $data, $parentId = null)
    {
        $menu = Menu::create([
            'label' => $data['label'],
            'label_nepali' => $data['label_nepali'] ?? null,
            'url' => $data['url'] ?? null,
            'position' => $data['position'] ?? 0,
            'icon' => $data['icon'] ?? null,
            'parent_id' => $parentId,
            'is_active' => $data['is_active'] ?? 1,
        ]);

        if (isset($data['children'])) {
            foreach ($data['children'] as $child) {
                $this->createMenu($child, $menu->id);
            }
        }
    }
}
