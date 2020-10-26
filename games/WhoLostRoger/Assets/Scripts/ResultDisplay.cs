using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

/*
 * This component script is used for displaying the result while a level 
 * is completed or game over.
 * 
 * In Unity inspector,
 * @require Text       textBox
 * @require Options    options
 * 
 */
public class ResultDisplay : MonoBehaviour
{
    public enum Options
    {
        currentLevel = 0,
        TimeUsed = 1,
        TimeLeft = 2,
        ScorePoint = 3,
        FinalScore = 4,  // score point + bonus score from time left
    }

    public Text textBox;
    public Options options;

    private void isTextBoxNull()
    {
        if (textBox == null)
        {
            ResultDisplay component = this.gameObject.GetComponent<ResultDisplay>();
            Destroy(component);

            Debug.Log(string.Format("Null text box assigned and the component won't work"));
        }
    }

    private void showResult()
    {
        switch (options)
        {
            case Options.currentLevel:
                textBox.text = "Current Level : " + DataStorage.getCurrentLevel().ToString();
                break;
            case Options.TimeUsed:
                textBox.text = "Time Used : " + Mathf.Round(DataStorage.getTimeUsed()).ToString();
                break;
            case Options.TimeLeft:
                textBox.text = "Time Left : " + Mathf.Round(DataStorage.getTimeLeft()).ToString();
                break;
            case Options.ScorePoint:
                textBox.text = "Score Point : " + DataStorage.getScorePoint().ToString();
                break;
            case Options.FinalScore:
                textBox.text = "Final Score : " + DataSystem.calculateTotalScore(Mathf.CeilToInt(DataStorage.getTimeLeft()), 
                        DataStorage.getScorePoint(), DataStorage.getTimePerScore());
                break;
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isTextBoxNull();
        showResult();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
