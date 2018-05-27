# IQ test emulator
Simple IQ test emulator, using roulette method to select questions

<h2>class.helper.php</h2>

<h3>class Helper</h3>
<p>Class contains different helper functions</p>

<h3>ChangeSettings($min, $max)</h3>

Change dificulty levels of all questions

@param int - min dificulty level

@param int - max dificulty level

@throws Exception if error

<h3>Reset()</h3>

<p>Reset the questions setting</p>

@throws Exception if error

<h3>FormRandomSet(questions)</h3>

Select 40 questions depends on using in previous tests. Using "Roulett method" to select questions with lesser using as weight

@param array(mixed) - array of questions

@return array(int) - array of questions ids

<h3>QuestionResult(level, iq)</h3>

Check does user successfuly answered the question or not

@param int - level of question dificutness

@param int - level of iq

@return bool successfully answered or not

<h3>RunEmulator(questions, iq)</h3>

Run emulator

@param array(mixed) - array of questions

@param int - level of iq

@return array(mixesd) - array, contains the results of emulating
