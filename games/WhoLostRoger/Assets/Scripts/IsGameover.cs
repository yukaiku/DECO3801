using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

/*
 * This component script is used for checking whether a level is game over 
 * or not according to a timer, and then providing optional reactions when 
 * it is triggered.
 * 
 * @depend NounTagUtility component script  ->  finding noun tag objects
 * @depend SendingData component script     ->  sending game data to server
 * 
 * In Unity inspector,
 * @require TimerUtility           timer
 * @require TimeroutOptions        timeoutOption
 * @require GameObject             gameoverMenu
 * @require string                 sceneName      (optional)
 * 
 */
public class IsGameover : MonoBehaviour
{

    public enum TimeoutOptions
    {
        nothing = 0,
        jumpScene = 1,
        showGameOver = 2
    }

    // vars for Timer
    public TimerUtility timer;
    public TimeoutOptions timeoutOptions;

    // vars for GameOverMenu
    public GameObject gameoverMenu;

    // vars for SceneChange
    [ChoiceList(new[] { "LoadingScene" })]
    public string sceneName;
    private bool trigger = false;
    private Text[] nounTextList;        // namely noun tag list
    private SendingData sender;

    private void isTimerNull()
    {
        if (timer == null)
        {
            IsGameover component = this.gameObject.GetComponent<IsGameover>();
            Destroy(component);

            Debug.Log(string.Format("Null timer assigned and the component won't work"));
        }
        sender = gameObject.AddComponent<SendingData>();
    }

    private void getNounTextList()
    {
        List<Text> nounTagList = new List<Text>();
        foreach (NounTagUtility nounTag in Object.FindObjectsOfType<NounTagUtility>())
        {
            Text tagText = nounTag.gameObject.GetComponent<Text>();
            if (tagText != null)
            {
                nounTagList.Add(tagText);
            }
        }
        nounTextList = nounTagList.ToArray();
        // save the number of total nouns in this level
        DataStorage.setCurrentNounCount(nounTextList.Length);

        Debug.Log(string.Format("In total '{0}' noun text box in this panel'", nounTextList.Length));
    }

    private void isTimeout()
    {
        if (!trigger && timer.timeStart <= 0)
        {
            trigger = true;

            if (trigger)
            {
                // save player real time spent
                DataStorage.setTimeUsed(timer.getTimeUsed());
                // save player time left
                DataStorage.setTimeLeft(timer.getTimeLeft());
                // send data to database in server side
                // sender.sendDataByJS();
                sender.sendData();
                // do something when timeout
                doSomething();
            }
        }
    }

    private void doSomething()
    {
        switch (timeoutOptions)
        {
            case TimeoutOptions.nothing:
                doNothing();
                break;
            case TimeoutOptions.jumpScene:
                doJumpScene();
                break;
            case TimeoutOptions.showGameOver:
                doShowGameOver();
                break;
            default:
                break;
        }
    }

    private void doNothing()
    {
        Debug.Log(string.Format("Timeout : Object '{0}' timer",
            this.gameObject.ToString()));
    }

    private void doJumpScene()
    {
        if ((sceneName != null) && (SceneManager.GetSceneByName(sceneName) != null))
        {
            SceneManager.LoadScene(sceneName);
            Debug.Log(string.Format("Timeout : load to '{0}' scene", sceneName));
        }
        else
        {
            Debug.Log(string.Format("Timeout : no such scene name"));
        }
    }

    private void doShowGameOver()
    {
        GameObject menu = Instantiate(gameoverMenu, gameoverMenu.transform.parent);
        Destroy(gameoverMenu);
        if (menu.activeSelf == false)
        {
            menu.SetActive(true);
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isTimerNull();
        getNounTextList();
    }

    // Update is called once per frame
    void Update()
    {
        isTimeout();
    }
}
