using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

// using the EventTrigger component for sprite objects
public class TimerUtility : MonoBehaviour
{
    public enum TimeoutOptions
    {
        nothing = 0,
        jumpScene = 1,
    }
    public float timeStart;
    public float timeout;
    public TimeoutOptions timeoutOptions;
    public string sceneName;        // jump to other scene when timeout, if provided

    private float timeStartBk;
    private bool timerActive = false;

    public void startTimer()
    {
        timeStartBk = timeStart;
        timerActive = true;
    }

    public void resetTimer()
    {
        timerActive = false;
        timeStart = timeStartBk;
    }

    public void clickTimer()
    {
        timerActive = !timerActive;
    }

    public void updateTimer()
    {
        if ((timerActive) && (timeStart <= timeout))
        {
            timeStart += Time.deltaTime;
            if (timeStart >= timeout)
            {
                // do something when timeout
                switch (timeoutOptions)
                {
                    case TimeoutOptions.nothing:
                        break;
                    case TimeoutOptions.jumpScene:
                        doJumpScene();
                        break;
                    default:
                        break;
                }
            }
        }
    }

    // jump to other scene when timeout
    public void doJumpScene()
    {
        Debug.Log(string.Format("Object '{0}' timer timeout", this.gameObject.ToString()));
        if (sceneName != null)
        {
            Debug.Log(string.Format("Timeout load to '{0}' scene", sceneName));
            SceneManager.LoadScene(sceneName);
        }
    }


    // Start is called before the first frame update
    void Start()
    {
        startTimer();
    }

    // Update is called once per frame
    void Update()
    {
        updateTimer();
    }
}
