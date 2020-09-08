using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;
using UnityEditor;

public class IsResult : MonoBehaviour
{
    public enum Options
    {
        nothing = 0,
        jumpScene = 1,
    }

    public TimerUtility timer;
    public Options options;
    [ChoiceList(new[] { "ResultScene" })]
    public string sceneName;

    private Text[] nounTextList;        // namely noun tag list
    private bool trigger = false;

    private void isArgsNull()
    {
        if (timer == null)
        {
            IsResult component = this.gameObject.GetComponent<IsResult>();
            Destroy(component);

            Debug.Log(string.Format("Null arguments assigned and the component won't work"));
        }
    }

    private void getNounTextList()
    {
        List<Text> nounTagList = new List<Text>();
        foreach (NounTagUtility nounTag in Resources.FindObjectsOfTypeAll(typeof(NounTagUtility)) as NounTagUtility[])
        {
            if (!EditorUtility.IsPersistent(nounTag.transform.root.gameObject)
                    && !(nounTag.hideFlags == HideFlags.NotEditable
                    || nounTag.hideFlags == HideFlags.HideAndDontSave))
                nounTagList.Add(nounTag.gameObject.GetComponent<Text>());
        }
        nounTextList = nounTagList.ToArray();

        Debug.Log(string.Format("In total '{0}' noun text box in this panel'", nounTextList.Length));
    }

    // trigger this event when a noun object is clicked
    public void isAllNounClicked()
    {
        if (!trigger)
        {
            int count = 0;
            for (int i = 0; i < nounTextList.Length; ++i)
            {
                if (!nounTextList[i].gameObject.activeSelf)
                {
                    count++;
                }

                if (count == nounTextList.Length)
                {
                    trigger = true;
                    Debug.Log(string.Format("All nouns clicked."));
                }
            }

            if (trigger)
            {
                // save player time spent
                DataSystem.saveTimeLeft(timer.timeStart);
                // do something when triggered
                doSomething();
            }
        }
    }

    private void doSomething()
    {
        switch (options)
        {
            case Options.nothing:
                doNothing();
                break;
            case Options.jumpScene:
                doJumpScene();
                break;
            default:
                break;
        }
    }

    private void doNothing()
    {
        Debug.Log(string.Format("Do nothing when all nouns clicked",
            this.gameObject.ToString()));
    }

    private void doJumpScene()
    {
        if ((sceneName != null) && (SceneManager.GetSceneByName(sceneName) != null))
        {
            SceneManager.LoadScene(sceneName);
            Debug.Log(string.Format("Load to '{0}' scene", sceneName));
        }
        else
        {
            Debug.Log(string.Format("No such scene name"));
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isArgsNull();
        getNounTextList();
    }

    // Update is called once per frame
    void Update()
    {

    }
}
