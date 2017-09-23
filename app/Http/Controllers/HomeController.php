<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


class SkillData
{
    public $name;
    public $experience;
    public $level;

    public function __construct($name, $experience, $level)
    {
        $this->name = $name;
        $this->experience = $experience;
        $this->level = $level;
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

    public static function getProjectTypes(){
        $projectTypes = array();

        $projectTypes[ProjectType::$web] = new ProjectType(ProjectType::$web, "Web", "language");
        $projectTypes[ProjectType::$mobile] = new ProjectType(ProjectType::$mobile, "Mobile", "phone_android");
        $projectTypes[ProjectType::$desktop] = new ProjectType(ProjectType::$desktop, "Desktop", "desktop_windows");
        $projectTypes[ProjectType::$iot] = new ProjectType(ProjectType::$iot, "IoT", "devices_other");
        $projectTypes[ProjectType::$game] = new ProjectType(ProjectType::$game, "Games", "videogame_asset");

        return $projectTypes;
    }

    public function __construct($type, $name, $icon){
        $this->type = $type;
        $this->name= $name;
        $this->icon = $icon;
    }

}

class ProjectData
{
    public $id;
    public $img_path="/images/projects/default.png";
    public $title;
    public $description = "";
    public $info_blade_name = "";
    public $types = array();

    public function __construct($id, $img_path, $title)
    {
        $this->id = $id;
        if($img_path!="")
            $this->img_path = $img_path;
        $this->title = $title;
        $this->info_blade_name = "dummy";
    }

    public function setInfoBladeName($info_blade_name){
        $this->info_blade_name = $info_blade_name;
    }

    public function addType($type)
    {
        array_push($this->types, $type);
    }
}

class ContactMeData
{
    public $phone;
    public $email;
    public $address;
}

class ResumeData{
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
        $skillsSection = new Section("skills", "Skills", "star", "/images/home/bg/skills_bg1.jpg");
        $projectsSection = new Section("projects", "Projects", "devices_other", "/images/home/bg/project_bg1.jpg");
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
            'skills' => $skillsSection,
            'projects' => $projectsSection,
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
        $currentRoles = new FieldValuePair("Current Roles", "Software Developer & Student");
        $collegeYear = new FieldValuePair("College Year", "Sophomore");
        $major = new FieldValuePair("Major", "Computer Science");
        $university = new FieldValuePair("University", "Southern Arkansas University");
        $phone = new FieldValuePair("Phone", "(501) 504 4820");
        $email = new FieldValuePair("Email", "aziztitu1996@gmail.com");
//        $lookingFor = new FieldValuePair("Looking for", "Internship in  Software Development");

        return [
            $fullName,
            $preferredName,
            $dob,
            $currentRoles,
            $collegeYear,
            $major,
            $university,
            $phone,
            $email
//            $lookingFor
        ];
    }

    private function createSkillsData()
    {
        $skillSet = array();

        array_push($skillSet, new SkillData("Android Development", 4, 80));
        array_push($skillSet, new SkillData("Web Development", 4, 90));
        array_push($skillSet, new SkillData("Windows Development", 6, 85));
        array_push($skillSet, new SkillData("Game Development", 3, 65));
        array_push($skillSet, new SkillData("Internet of Things", 2, 60));
        array_push($skillSet, new SkillData("Unity3D", 2, 60));
        array_push($skillSet, new SkillData("Java", 5, 85));
        array_push($skillSet, new SkillData("PHP", 5, 85));
        array_push($skillSet, new SkillData("C#", 3, 70));
        array_push($skillSet, new SkillData("C++", 3, 70));
        array_push($skillSet, new SkillData("Python", 3, 65));
        array_push($skillSet, new SkillData("MySQL", 5, 80));
        array_push($skillSet, new SkillData("HTML", 6, 95));
        array_push($skillSet, new SkillData("CSS", 6, 90));
        array_push($skillSet, new SkillData("JavaScript", 5, 85));
        array_push($skillSet, new SkillData("jQuery", 5, 85));
        array_push($skillSet, new SkillData("React JS", 2, 70));
        array_push($skillSet, new SkillData("Laravel", 2, 70));
        array_push($skillSet, new SkillData("Windows Presentation Framework (WPF)", 2, 50));
        array_push($skillSet, new SkillData("JSP", 2, 60));
        array_push($skillSet, new SkillData("Django", 1, 55));
        array_push($skillSet, new SkillData("Git", 4, 85));
        array_push($skillSet, new SkillData("Processing", 2, 75));
        array_push($skillSet, new SkillData("Arduino", 2, 75));
        array_push($skillSet, new SkillData("Data Structures", 4, 85));
        array_push($skillSet, new SkillData("Algorithms", 4, 85));
        array_push($skillSet, new SkillData("Networking", 4, 65));

        return $skillSet;
    }

    private function createProjectsData()
    {
        $projectTypes = ProjectType::getProjectTypes();

        $projectCollection1 = new ProjectCollection("Default");
        $projectCollection1->setProjectTypes($projectTypes);

        $seamlessTimecard = new ProjectData("seamless_timecard", "/images/projects/seamless_timecard.png", "Seamless Timecard");
        $seamlessTimecard->description = "Seamless Timecard is an end-to-end solution for employee scheduling and attendance management. I developed apps for Android and Windows that the employees use to clock in and out. I also developed the website with a dashboard that the employer can use to manage the employees.";
        $seamlessTimecard->addType($projectTypes[ProjectType::$web]);
        $seamlessTimecard->addType($projectTypes[ProjectType::$mobile]);
        $seamlessTimecard->addType($projectTypes[ProjectType::$desktop]);
        $seamlessTimecard->setInfoBladeName("seamlesstimecard");

        $seamlessPos = new ProjectData("seamless_pos", "/images/projects/seamless_pos.jpg", "Seamless POS");
        $seamlessPos->addType($projectTypes[ProjectType::$web]);
        $seamlessPos->addType($projectTypes[ProjectType::$desktop]);
        $seamlessPos->addType($projectTypes[ProjectType::$mobile]);

        $dealout = new ProjectData("dealout", "/images/projects/dealout.jpg", "DealOut");
        $dealout->addType($projectTypes[ProjectType::$mobile]);

        $androidColorPickerLibrary = new ProjectData("android_color_picker_library", "/images/projects/android_color_picker.jpg", "Android Color Picker Library");
        $androidColorPickerLibrary->addType($projectTypes[ProjectType::$mobile]);

        $sauHonorsApp = new ProjectData("sau_honors_app", "/images/projects/honors_app.jpg", "SAU Honors College App");
        $sauHonorsApp->addType($projectTypes[ProjectType::$mobile]);

        $miniRobot = new ProjectData("mini_robot", "/images/projects/mini_robot.jpg", "Mini Robot");
        $miniRobot->addType($projectTypes[ProjectType::$iot]);
        $miniRobot->addType($projectTypes[ProjectType::$mobile]);
        $miniRobot->addType($projectTypes[ProjectType::$desktop]);

        $ironManHand = new ProjectData("iron_man_hand", "/images/projects/iron_man_glove.jpg", "Iron Man Glove");
        $ironManHand->addType($projectTypes[ProjectType::$iot]);

        $azBrowser = new ProjectData("az_browser", "/images/projects/az_browser.jpg", "Floating Web Browser");
        $azBrowser->addType($projectTypes[ProjectType::$desktop]);

        $chitChat = new ProjectData("chit_chat", "/images/projects/chit_chat.jpg", "Chit Chat");
        $chitChat->addType($projectTypes[ProjectType::$desktop]);

        $ddnsUpdater = new ProjectData("ddns_updater", "/images/projects/ddns_updater.jpg", "DDNS Updater");
        $ddnsUpdater->addType($projectTypes[ProjectType::$desktop]);
        $ddnsUpdater->addType($projectTypes[ProjectType::$mobile]);
        $ddnsUpdater->addType($projectTypes[ProjectType::$web]);

        $azids = new ProjectData("azids", "/images/projects/azids.jpg", "AZ Intrusion Detection System (Demo)");
        $azids ->addType($projectTypes[ProjectType::$desktop]);


        $seamlessVNC = new ProjectData("seamless_vnc", "/images/projects/seamless_vnc.jpg", "Seamless VNC");
        $seamlessVNC->addType($projectTypes[ProjectType::$desktop]);

        $wiiPCRemote = new ProjectData("wii_pc_remote", "", "Wii PC Remote");
        $wiiPCRemote->addType($projectTypes[ProjectType::$desktop]);

        $sauCricketGame = new ProjectData("sau_cricket_game", "/images/projects/sau_cricket_game.jpg", "SAU Cricket Game");
        $sauCricketGame->addType($projectTypes[ProjectType::$desktop]);
        $sauCricketGame->addType($projectTypes[ProjectType::$game]);

        $repulse = new ProjectData("repulse", "/images/projects/repulse.jpg", "Repulse");
        $repulse ->addType($projectTypes[ProjectType::$desktop]);
        $repulse ->addType($projectTypes[ProjectType::$game]);



        $projectCollection1->addProject($seamlessTimecard);
        $projectCollection1->addProject($seamlessPos);
        $projectCollection1->addProject($dealout);
        $projectCollection1->addProject($androidColorPickerLibrary);
        $projectCollection1->addProject($sauHonorsApp);
        $projectCollection1->addProject($azBrowser);
        $projectCollection1->addProject($seamlessVNC);
        $projectCollection1->addProject($ddnsUpdater);
        $projectCollection1->addProject($azids);
        $projectCollection1->addProject($chitChat);
        $projectCollection1->addProject($miniRobot);
        $projectCollection1->addProject($ironManHand);
        $projectCollection1->addProject($wiiPCRemote);
        $projectCollection1->addProject($sauCricketGame);
        $projectCollection1->addProject($repulse);

        return [
            $projectCollection1
        ];
    }

    private function createContactMeData(){
        $contactMeData = new ContactMeData();
        $contactMeData->phone = "(501) 504 4820";
        $contactMeData->email = "aziztitu1996@gmail.com";
        $contactMeData->address = "302 N Yocum Ave, El Dorado, AR 71730";

        return $contactMeData;
    }

    public function createResumeData(){
        $resumeData = new ResumeData();
        $resumeData->resumeURL = "/files/MyResume.pdf";

        return $resumeData;
    }
}
