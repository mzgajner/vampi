<?php

namespace AppBundle\Command;

use AppBundle\Entity\Term;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vampi:fill')
            ->setDescription('Fill the database with words from a webpage')
            ->addArgument('url', InputArgument::REQUIRED, 'URL address of the webpage')
            ->addArgument('lang', InputArgument::REQUIRED, 'Language (sl/en/de)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $lang = $input->getArgument('lang');

        $client = $this->getContainer()->get('guzzle.client');

        $request = $client->get($url);
        $response = $request->send();

        $text = $response->getBody(true);

        $text = mb_ereg_replace('<style\b[^>]*>(.*?)<\/style>', ' ', $text);
        $text = mb_ereg_replace('<script\b[^>]*>(.*?)<\/script>', ' ', $text);
        $text = strip_tags($text);

        $text = mb_ereg_replace('\|', ' ', $text);
        $text = mb_ereg_replace('[^A-Ža-ž]', ' ', $text);
        $text = mb_ereg_replace('\s+', ' ', $text);

        $words = explode(' ', $text);

        $w = null;
        $terms = [];
        $em = $this->getContainer()->get('doctrine')->getManager();

        foreach ($words as $word) {
            if (mb_strlen($word, 'UTF-8') <= 3) {
                continue;
            }

            try {
                $w = mb_strtolower($this->getContainer()->get('lemmatizer')->convert($word, $lang), 'UTF-8');
            } catch (\Exception $e) {
                $output->writeln($e->getMessage() . " [".$word."]");
                continue;
            }

            if (in_array($w, $this->getStopWords($lang)) || mb_strlen($w, 'UTF-8') <= 3) {
                continue;
            }

            if (!in_array($w, $terms, true)) {
                $terms[] = $w;
                $termObj = new Term($w, $lang);
                try {
                    $em->persist($termObj);
                    $em->flush();
                } catch (\Exception $e) {}
            }
        }
    }

    private function getStopWords($lang) {
        $stopWords = array(
            'sl' => array("ali","ampak","brez","čeprav","čez","enako","isto","kadar","kaj","kajti","kakor","kdo","ker","kot","marsikaj","mnogo","namreč","nasproti","neko","nisem","niti","okoli","okrog","oziroma","prav","pred","preden","razen","sem","sicer","sploh","tega","temle","temveč","ter","toda","torej","tudi","vendar","verjetno","zakaj","zares","zlasti"),
            'en' => array("a","about","above","after","again","against","all","am","an","and","any","are","aren't","as","at","be","because","been","before","being","below","between","both","but","by","can't","cannot","could","couldn't","did","didn't","do","does","doesn't","doing","don't","down","during","each","few","for","from","further","had","hadn't","has","hasn't","have","haven't","having","he","he'd","he'll","he's","her","here","here's","hers","herself","him","himself","his","how","how's","i","i'd","i'll","i'm","i've","if","in","into","is","isn't","it","it's","its","itself","let's","me","more","most","mustn't","my","myself","no","nor","not","of","off","on","once","only","or","other","ought","our","ours	ourselves","out","over","own","same","shan't","she","she'd","she'll","she's","should","shouldn't","so","some","such","than","that","that's","the","their","theirs","them","themselves","then","there","there's","these","they","they'd","they'll","they're","they've","this","those","through","to","too","under","until","up","very","was","wasn't","we","we'd","we'll","we're","we've","were","weren't","what","what's","when","when's","where","where's","which","while","who","who's","whom","why","why's","with","won't","would","wouldn't","you","you'd","you'll","you're","you've","your","yours","yourself","yourselves"),
            'de' => array("aber","als","am","an","auch","auf","aus","bei","bin","bis","bist","da","dadurch","daher","darum","das","daß","dass","dein","deine","dem","den","der","des","dessen","deshalb","die","dies","dieser","dieses","doch","dort","du","durch","ein","eine","einem","einen","einer","eines","er","es","euer","eure","für","hatte","hatten","hattest","hattet","hier	hinter","ich","ihr","ihre","im","in","ist","ja","jede","jedem","jeden","jeder","jedes","jener","jenes","jetzt","kann","kannst","können","könnt","machen","mein","meine","mit","muß","mußt","musst","müssen","müßt","nach","nachdem","nein","nicht","nun","oder","seid","sein","seine","sich","sie","sind","soll","sollen","sollst","sollt","sonst","soweit","sowie","und","unser	unsere","unter","vom","von","vor","wann","warum","was","weiter","weitere","wenn","wer","werde","werden","werdet","weshalb","wie","wieder","wieso","wir","wird","wirst","wo","woher","wohin","zu","zum","zur","über"),
        );

        return $stopWords[$lang];
    }
}


