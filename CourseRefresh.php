<?php



class CourseRefresh {

    /**
     * @var CourceSourceInterface
     */
    private $source;
    /**
     * @var CourseLoaderInterface
     */
    private $loader;
    /**
     * @var CourseManager
     */
    private $manager;

    public function __construct(CourceSourceInterface $source, CourseLoaderInterface $loader, CourseManager $manager )
    {
        $this->source = $source;
        $this->loader = $loader;
        $this->manager = $manager;
    }

    public static function do() {
        $source = new CourceSource("http://localahost");
        $manager = new CourseManager(new DB(), new Cache());
        (new self($source, new CourseLoader($source), $manager))->refresh();
    }

    public function refresh(): void
    {
        $raw = $this->loader->load();
        if (!$raw) {
            return;
        }
        foreach($this->source->parse($raw) as $cource) {
            /**
             * @var Cource $cource
             */
            $this->manager->add($cource);
        }

    }
}

CourseRefresh::do();