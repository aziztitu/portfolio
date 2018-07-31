<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;


class Section
{
    public $id;
    public $name;
    public $icon_name;
    public $bg_path;
    public $section_data;

    public function __construct($id, $name, $icon_name, $bg_path)
    {
        $this->id = $id;
        $this->name = $name;
        $this->icon_name = $icon_name;
        $this->bg_path = $bg_path;
    }
}

class FieldValuePair
{
    public $field;
    public $value;

    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }
}


class ProjectCollection
{
    public $name;
    public $projects = array();
    public $projectTypes = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addProject($project)
    {
        array_push($this->projects, $project);
    }

    public function setProjectTypes($projectTypes)
    {
        $this->projectTypes = $projectTypes;
    }
}

class ProjectType
{
    public static $web = "web";
    public static $mobile = "mobile";
    public static $desktop = "desktop";
    public static $iot = "iot";
    public static $game = "game";

    public $type;
    public $name;
    public $icon;

    public static function getProjectTypes()
    {
        $projectTypes = array();

        $projectTypes[ProjectType::$web] = new ProjectType(ProjectType::$web, "Web", "language");
        $projectTypes[ProjectType::$mobile] = new ProjectType(ProjectType::$mobile, "Mobile", "phone_android");
        $projectTypes[ProjectType::$desktop] = new ProjectType(ProjectType::$desktop, "Desktop", "desktop_windows");
        $projectTypes[ProjectType::$game] = new ProjectType(ProjectType::$game, "Games", "videogame_asset");
        $projectTypes[ProjectType::$iot] = new ProjectType(ProjectType::$iot, "IoT", "devices_other");

        return $projectTypes;
    }

    public function __construct($type, $name, $icon)
    {
        $this->type = $type;
        $this->name = $name;
        $this->icon = $icon;
    }

}

class ProjectData
{
    public $id;
    public $img_path = "/images/projects/default.png";
    public $title;
    public $description = "";
    public $types = array();
    public $infoVideos = array();
    public $infoImages = array();

    public function __construct($id, $img_path, $title)
    {
        $this->id = $id;
        if ($img_path != "")
            $this->img_path = $img_path;
        $this->title = $title;

        $this->retrieveInfoImages();
    }

    public function addType($type)
    {
        array_push($this->types, $type);
    }

    public function addInfoVideo($link, $thumbPath, $ratio = 1.5)
    {
        array_push($this->infoVideos, ['link' => $link, 'thumbPath' => $thumbPath, 'ratio' => $ratio]);
    }

    public function addInfoImage($path, $thumbPath, $ratio = 1.5)
    {
        array_push($this->infoImages, ['path' => $path, 'thumbPath' => $thumbPath, 'ratio' => $ratio]);
    }

    private function retrieveInfoImages()
    {
        $projectInfoDirName = 'project_info/' . $this->id;

        $publicStorageDisk = Storage::disk('public');
        $filenames = $publicStorageDisk->files($projectInfoDirName);

        foreach ($filenames as $filename) {
            $img_data = getimagesize($publicStorageDisk->url($filename));
            $width = $img_data[0];
            $height = $img_data[1];

            $publicFilename = $publicStorageDisk->url($filename);
            $publicThumbFilename = $publicStorageDisk->url(dirname($filename) . '/thumbs/' . basename($filename));

            $this->addInfoImage($publicFilename, $publicThumbFilename, $width / $height);
        }

//        echo var_dump($filenames);
    }
}


class SkillSet
{
    public $name;
    public $skills = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addSkill($skill)
    {
        array_push($this->skills, $skill);
    }
}

class SkillData
{
    public $name;
    public $experience;
    public $level;
    public $icon_class;
    public $icon_content;

    public function __construct($name, $experience, $level, $icon_class = 'icon-shell', $icon_content = '')
    {
        $this->name = $name;
        $this->experience = $experience;
        $this->level = $level;
        $this->icon_class = $icon_class;
        $this->icon_content = $icon_content;
    }
}


class ContactMeData
{
    public $phone;
    public $email;
    public $address;
}


class ResumeData
{
    public $resumeURL;
}


class HomeController extends Controller
{
    private $homePageData = ['title' => "Azee's Portfolio"];

    public function showWelcome()
    {
        $this->homePageData["activeSection"] = "welcome";

        JavaScriptFacade::put($this->homePageData);
        return $this->showHomePage();
    }

    private function showHomePage()
    {
        $this->homePageData["sectionData"] = $this->createSections();
        return view('pages.home.main', $this->homePageData);
    }

    private function createSections()
    {
        $welcomeSection = new Section("welcome", "Welcome", "home", "/images/home/bg/tech_bg2.jpg");
        $aboutMeSection = new Section("about_me", "About Me", "person", "/images/home/bg/personal_bg2.jpg");
        $projectsSection = new Section("projects", "Projects", "devices_other", "/images/home/bg/project_bg1.jpg");
        $skillsSection = new Section("skills", "Skills", "star", "/images/home/bg/skills_bg1.jpg");
        $educationSection = new Section("education", "Education", "school", "/images/home/bg/education_bg1.jpg");
        $contactMeSection = new Section("contact_me", "Contact Me", "question_answer", "/images/home/bg/contact_bg1.jpg");
        $resumeSection = new Section("resume", "Resume", "receipt", "/images/home/bg/tech_bg3.jpg");

        $aboutMeSection->section_data = $this->createAboutMeData();
        $projectsSection->section_data = $this->createProjectsData();
        $skillsSection->section_data = $this->createSkillsData();
        $contactMeSection->section_data = $this->createContactMeData();
        $resumeSection->section_data = $this->createResumeData();

        return [
            'welcome' => $welcomeSection,
            'about_me' => $aboutMeSection,
            'projects' => $projectsSection,
            'skills' => $skillsSection,
//            'education' => $educationSection,
            'contact_me' => $contactMeSection,
            'resume' => $resumeSection
        ];
    }

    private function createAboutMeData()
    {
        $fullName = new FieldValuePair("Full Name", "Aziztitu Murugan");
        $preferredName = new FieldValuePair("Preferred Name", "Azee");
        $dob = new FieldValuePair("Date of Birth", "June 28 1996");
        $currentRoles = new FieldValuePair("Current Roles", "Student / Software Developer");
        $collegeYear = new FieldValuePair("College Year", "Junior");
        $major = new FieldValuePair("Major", "Computer Science");
        $university = new FieldValuePair("University", "Southern Arkansas University");
        $phone = new FieldValuePair("Phone", "(501) 504 4820");
        $email = new FieldValuePair("Email", "aziztitu1996@gmail.com");
        $lookingFor = new FieldValuePair("Looking for", "Software Engineering Internship");

        return [
            $fullName,
            $preferredName,
            $dob,
            $currentRoles,
            $collegeYear,
            $major,
            $university,
            $phone,
            $email,
            $lookingFor
        ];
    }

    private function createProjectsData()
    {
        $projectTypes = ProjectType::getProjectTypes();

        $projectCollection1 = new ProjectCollection("Default");
        $projectCollection1->setProjectTypes($projectTypes);

        $seamlessTimecard = new ProjectData("seamless_timecard", "/images/projects/thumbs/seamless_timecard.png", "Seamless Timecard");
        $seamlessTimecard->description = "Seamless Timecard is an end-to-end solution for employee scheduling and attendance management. I developed apps for Android and Windows that the employees use to clock in and out. I also developed the website with a dashboard that the employer can use to manage the employees.";
        $seamlessTimecard->addType($projectTypes[ProjectType::$web]);
        $seamlessTimecard->addType($projectTypes[ProjectType::$mobile]);
        $seamlessTimecard->addType($projectTypes[ProjectType::$desktop]);
        $seamlessTimecard->addInfoVideo('https://www.youtube.com/watch?v=DGnTKMmLjc8', '/storage/project_info/seamless_timecard/thumbs/3_windows_1.png');

        $seamlessPos = new ProjectData("seamless_pos", "/images/projects/thumbs/seamless_pos.jpg", "Seamless POS");
        $seamlessPos->addType($projectTypes[ProjectType::$web]);
        $seamlessPos->addType($projectTypes[ProjectType::$desktop]);
        $seamlessPos->addType($projectTypes[ProjectType::$mobile]);

        $dealout = new ProjectData("dealout", "/images/projects/thumbs/dealout.jpg", "DealOut");
        $dealout->addType($projectTypes[ProjectType::$mobile]);

        $androidColorPickerLibrary = new ProjectData("android_color_picker_library", "/images/projects/thumbs/android_color_picker.jpg", "Android Color Picker Library");
        $androidColorPickerLibrary->addType($projectTypes[ProjectType::$mobile]);

        $sauHonorsApp = new ProjectData("sau_honors_app", "/images/projects/thumbs/honors_app.jpg", "SAU Honors College App");
        $sauHonorsApp->addType($projectTypes[ProjectType::$mobile]);

        $azmapGenerator = new ProjectData("azmap_generator", "/images/projects/thumbs/azmap_generator.png", "AZMAP Generator");
        $azmapGenerator->addType($projectTypes[ProjectType::$desktop]);

        $miniRobot = new ProjectData("mini_robot", "/images/projects/thumbs/mini_robot.jpg", "Mini Robot");
        $miniRobot->addType($projectTypes[ProjectType::$iot]);
        $miniRobot->addType($projectTypes[ProjectType::$mobile]);
        $miniRobot->addType($projectTypes[ProjectType::$desktop]);

        $ironManGlove = new ProjectData("iron_man_glove", "/images/projects/thumbs/iron_man_glove.jpg", "Iron Man Glove");
        $ironManGlove->addType($projectTypes[ProjectType::$iot]);
        $ironManGlove->addType($projectTypes[ProjectType::$desktop]);

        $floatingWebBrowser = new ProjectData("floating_web_browser", "/images/projects/thumbs/floating_web_browser.jpg", "Floating Web Browser");
        $floatingWebBrowser->addType($projectTypes[ProjectType::$desktop]);

        $chitChat = new ProjectData("chit_chat", "/images/projects/thumbs/chit_chat.jpg", "Chit Chat");
        $chitChat->addType($projectTypes[ProjectType::$desktop]);

        $ddnsUpdater = new ProjectData("ddns_updater", "/images/projects/thumbs/ddns_updater.jpg", "DDNS Updater");
        $ddnsUpdater->addType($projectTypes[ProjectType::$desktop]);
        $ddnsUpdater->addType($projectTypes[ProjectType::$mobile]);
        $ddnsUpdater->addType($projectTypes[ProjectType::$web]);

        $ids = new ProjectData("ids", "/images/projects/thumbs/ids.jpg", "Intrusion Detection System (Demo)");
        $ids->addType($projectTypes[ProjectType::$desktop]);


        $seamlessVNC = new ProjectData("seamless_vnc", "/images/projects/thumbs/seamless_vnc.jpg", "Seamless VNC");
        $seamlessVNC->addType($projectTypes[ProjectType::$desktop]);

        $wiiPCRemote = new ProjectData("wii_pc_remote", "", "Wii PC Remote");
        $wiiPCRemote->addType($projectTypes[ProjectType::$desktop]);

        $sauCricketGame = new ProjectData("sau_cricket_game", "/images/projects/thumbs/sau_cricket_game.jpg", "SAU Cricket Game");
        $sauCricketGame->addType($projectTypes[ProjectType::$game]);
        $sauCricketGame->addType($projectTypes[ProjectType::$desktop]);

        $repulse = new ProjectData("repulse", "/images/projects/thumbs/repulse.jpg", "Repulse");
        $repulse->addType($projectTypes[ProjectType::$game]);
        $repulse->addType($projectTypes[ProjectType::$desktop]);

        $lightningWizard = new ProjectData("lightning_wizard", "/images/projects/thumbs/lightning_wizard.png", "Lightning Wizard");
        $lightningWizard->addType($projectTypes[ProjectType::$game]);
        $lightningWizard->addType($projectTypes[ProjectType::$desktop]);
        $lightningWizard->addInfoVideo("https://www.youtube.com/watch?v=sVsUsFzDj1w", "/storage/project_info/lightning_wizard/thumbs/1_windows_2.png");

        $cashFlow = new ProjectData("cash_flow", "/images/projects/thumbs/cash_flow.png", "Cash Flow");
        $cashFlow->addType($projectTypes[ProjectType::$game]);
        $cashFlow->addType($projectTypes[ProjectType::$desktop]);

        $peckyTheWoodpecker = new ProjectData("pecky_the_woodpecker", "/images/projects/thumbs/pecky_the_woodpecker.png", "Pecky the Woodpecker");
        $peckyTheWoodpecker->addType($projectTypes[ProjectType::$game]);
        $peckyTheWoodpecker->addType($projectTypes[ProjectType::$desktop]);

        $malware = new ProjectData("malware", "/images/projects/thumbs/malware.png", "Malware");
        $malware->addType($projectTypes[ProjectType::$game]);
        $malware->addType($projectTypes[ProjectType::$desktop]);

        $projectCollection1->addProject($seamlessTimecard);
        $projectCollection1->addProject($seamlessPos);
        $projectCollection1->addProject($dealout);
        $projectCollection1->addProject($androidColorPickerLibrary);
        $projectCollection1->addProject($sauHonorsApp);
        $projectCollection1->addProject($azmapGenerator);
        $projectCollection1->addProject($floatingWebBrowser);
        $projectCollection1->addProject($seamlessVNC);
        $projectCollection1->addProject($ddnsUpdater);
        $projectCollection1->addProject($ids);
        $projectCollection1->addProject($chitChat);
        $projectCollection1->addProject($miniRobot);
        $projectCollection1->addProject($ironManGlove);
        $projectCollection1->addProject($wiiPCRemote);
        $projectCollection1->addProject($malware);
        $projectCollection1->addProject($lightningWizard);
        $projectCollection1->addProject($cashFlow);
        $projectCollection1->addProject($peckyTheWoodpecker);
        $projectCollection1->addProject($repulse);
        $projectCollection1->addProject($sauCricketGame);

        return [
            $projectCollection1
        ];
    }

    private function createSkillsData()
    {
        $skillSets = array();

        $programmingSkillSet = new SkillSet("Programming Languages");
        $programmingSkillSet->addSkill(new SkillData("Java", 6, 85, 'icon-java-bold'));
        $programmingSkillSet->addSkill(new SkillData("PHP", 6, 85, 'icon-php-alt'));
        $programmingSkillSet->addSkill(new SkillData("JavaScript", 6, 85, 'icon-javascript-alt'));
        $programmingSkillSet->addSkill(new SkillData("C#", 4, 75, 'icon-csharp'));
        $programmingSkillSet->addSkill(new SkillData("C++", 4, 70, 'icon-cplusplus'));
        $programmingSkillSet->addSkill(new SkillData("Python", 4, 70, 'icon-python'));
        $programmingSkillSet->addSkill(new SkillData("MySQL", 6, 80, 'icon-mysql'));
        $programmingSkillSet->addSkill(new SkillData("HTML5", 7, 95, 'icon-html5'));
        $programmingSkillSet->addSkill(new SkillData("CSS3", 7, 90, 'icon-css3'));

        $platformsSkillSet = new SkillSet("Platforms/Libraries");
        $platformsSkillSet->addSkill(new SkillData("Web Development", 5, 90, 'material-icons', 'web'));
        $platformsSkillSet->addSkill(new SkillData("Android Development", 5, 80, 'devicon-android-plain'));
        $platformsSkillSet->addSkill(new SkillData("Windows Development", 7, 85, 'devicon-windows8-original'));
        $platformsSkillSet->addSkill(new SkillData("Game Development", 4, 80, 'material-icons', 'videogame_asset'));
        $platformsSkillSet->addSkill(new SkillData("Internet of Things", 2, 65, 'material-icons', 'devices_other'));
        $platformsSkillSet->addSkill(new SkillData("Unity3D", 3, 80, 'icon-unity'));
        $platformsSkillSet->addSkill(new SkillData("jQuery", 5, 85, 'icon-jquery'));
        $platformsSkillSet->addSkill(new SkillData("React JS", 2, 70, 'icon-reactjs'));
        $platformsSkillSet->addSkill(new SkillData("TypeScript", 2, 85, 'devicon-typescript-plain'));
        $platformsSkillSet->addSkill(new SkillData("Laravel", 3, 75, 'icon-laravel'));
        $platformsSkillSet->addSkill(new SkillData("Windows Presentation Framework (WPF)", 3, 60, 'material-icons', 'laptop_windows'));
        $platformsSkillSet->addSkill(new SkillData("JSP", 2, 60, 'material-icons', 'code'));
        $platformsSkillSet->addSkill(new SkillData("Django", 1, 55, 'devicon-django-plain'));
        $platformsSkillSet->addSkill(new SkillData("Git", 5, 90, 'devicon-git-plain'));
        $platformsSkillSet->addSkill(new SkillData("Processing", 2, 75, 'material-icons', 'code'));
        $platformsSkillSet->addSkill(new SkillData("Arduino", 2, 75, 'material-icons', 'code'));

        array_push($skillSets, $programmingSkillSet);
        array_push($skillSets, $platformsSkillSet);

        return $skillSets;
    }

    private function createContactMeData()
    {
        $contactMeData = new ContactMeData();
        $contactMeData->phone = "(501) 504 4820";
        $contactMeData->email = "aziztitu1996@gmail.com";
        $contactMeData->address = "302 N Yocum Ave, El Dorado, AR 71730";

        return $contactMeData;
    }

    public function createResumeData()
    {
        $resumeData = new ResumeData();
        $resumeData->resumeURL = "/files/MyResume.pdf";

        return $resumeData;
    }
}
