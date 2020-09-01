using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.UIElements;

public class TimerUtility : MonoBehaviour
{
    public float timeStart;                  // time provided to start count down
    public Text timeShow;                    // show current time left

    private float timeStartSave;             // back up the start time
    private bool timerActive = false;

    public void resetTimer()
    {
        timerActive = true;
        timeStart = timeStartSave;
        if (timeShow != null)
        {
            timeShow.text = Mathf.Round(timeStart).ToString();
        }
    }

    public void clickTimer()
    {
        timerActive = !timerActive;
        Debug.Log(string.Format("Timer has been clicked"));
    }

    private void startTimer()
    {
        timeStartSave = timeStart;
        timerActive = true;
        if (timeShow != null)
        {
            timeShow.text = Mathf.Round(timeStart).ToString();
        } else
        {
            Debug.Log(string.Format("Null timer : won't show time text"));
        }
    }

    private void updateTimer()
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
        if (timeShow != null)
        {
            timeShow.text = Mathf.Round(timeStart).ToString();
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        startTimer();
    }

    // Update is called once per frame
    void Update()
    {
        updateTimer();
        showTime();
    }
}
