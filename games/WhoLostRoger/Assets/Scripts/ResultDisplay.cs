using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class ResultDisplay : MonoBehaviour
{
    public enum Options
    {
        currentLevel = 0,
        TimeLeft = 1,
        ScorePoint = 2,
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
            case Options.TimeLeft:
                textBox.text = "Time Left : " + Mathf.Round(DataStorage.getTimeLeft()).ToString();
                break;
            case Options.ScorePoint:
                textBox.text = "Score Point : " + DataStorage.getScorePoint().ToString();
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
