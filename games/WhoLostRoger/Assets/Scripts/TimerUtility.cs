using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class TimerUtility : MonoBehaviour
{
    public float timeStart;                  // time provided to start count down
    [Tooltip("optional")]
    public Text timeBox;                     // show current time left
    private float timeStartSave;             // back up the start time
    private bool timerActive;

    public void clickTimer()
    {
        timerActive = !timerActive;
        Debug.Log(string.Format("Timer has been clicked"));
    }

    public void resetDefault()
    {
        timerActive = true;
        timeStart = timeStartSave;
        if (timeBox != null)
            timeBox.text = Mathf.Round(timeStart).ToString();
    }

    public void resetNew(float timeStart)
    {
        timeStartSave = timeStart;
        resetDefault();
    }

    public void timeUp(int increment)
    {
        if (timeStart + increment >= timeStartSave)
            timeStart = timeStartSave;
        else
            timeStart += increment;
    }

    public void timeDown(int decrement)
    {
        timeStart -= decrement;
        if (timeStart <= 0)
        {
            timeStart = 0;
        }
    }

    private void isTimeBoxNull()
    {
        if (timeBox == null)
            Debug.Log(string.Format("No time box assigned, and timer still working"));
    }

    private void updateTime()
    {
        if ((timerActive) && (timeStart >= 0))
        {
            timeStart -= Time.deltaTime;
            if (timeStart <= 0)
            {
                timerActive = false;
                timeStart = 0;
            }
        }
    }

    private void showTime()
    {
        if (timeBox != null)
            timeBox.text = Mathf.CeilToInt(timeStart).ToString();
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isTimeBoxNull();
        resetNew(timeStart);
    }

    // Update is called once per frame
    void Update()
    {
        updateTime();
        showTime();
    }
}
